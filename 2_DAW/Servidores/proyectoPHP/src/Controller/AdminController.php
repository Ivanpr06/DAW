<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Entity\Genero;
use App\Entity\Serie;
use App\Entity\Usuario;
use App\Entity\Valoracion;
use App\Repository\UsuarioRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Routing\Attribute\Route;

final class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function admin(UsuarioRepository $usuarioRepository, EntityManagerInterface $entityManager): Response
    {
        $usuarios = $usuarioRepository->findAll();

        $totalSeries = $entityManager->getRepository(Serie::class)->count([]);
        $totalValoraciones = $entityManager->getRepository(Valoracion::class)->count([]);
        $totalCategorias = $entityManager->getRepository(Categoria::class)->count([]);

        return $this->render('admin/admin.html.twig', [
            'usuarios' => $usuarios,
            'totalSeries' => $totalSeries,
            'totalValoraciones' => $totalValoraciones,
            'totalCategorias' => $totalCategorias,
        ]);
    }

    #[Route('/admin/serie/load', name: 'app_cargarDatos')]
    public function cargar_datos(HttpClientInterface $httpClient, EntityManagerInterface $entityManager): Response
    {
        $mapaGeneros = $this->cargarGeneros($httpClient, $entityManager);

        $todasLasSeries = [];

        $response = $httpClient->request('GET', 'https://api.themoviedb.org/3/discover/tv?api_key=097778a820e970e252345042fc4ce752&with_networks=56&language=es-ES&page=1');
        $content = $response->toArray();
        $totalPaginas = $content['total_pages'];

        $nuevasSeries = $this->procesarResultados($content['results'], $entityManager, $mapaGeneros);
        $todasLasSeries = array_merge($todasLasSeries, $nuevasSeries);

        for($numPag = 2; $numPag <= $totalPaginas; $numPag++) {
            $response = $httpClient->request('GET', 'https://api.themoviedb.org/3/discover/tv?api_key=097778a820e970e252345042fc4ce752&with_networks=56&language=es-ES&page=' . $numPag);
            $content = $response->toArray();

            $nuevasSeries = $this->procesarResultados($content['results'], $entityManager, $mapaGeneros);
            $todasLasSeries = array_merge($todasLasSeries, $nuevasSeries);
        }

        $entityManager->flush();

        return $this->render('admin/dataLoad.html.twig', [
            'controller_name' => 'AdminController',
            'listaSeries' => $todasLasSeries,
        ]);
    }

    private function cargarGeneros(HttpClientInterface $httpClient, EntityManagerInterface $entityManager): array
    {
        $response = $httpClient->request(
            'GET',
            'https://api.themoviedb.org/3/genre/tv/list?api_key=097778a820e970e252345042fc4ce752&language=es-ES'
        );

        $data = $response->toArray();
        $generosApi = $data['genres'];

        $repositorioGenero = $entityManager->getRepository(Genero::class);
        $listaGenero = [];

        foreach ($generosApi as $todosGenero) {
            $idApi = $todosGenero['id'];
            $nombre = $todosGenero['name'];

            $genero = $repositorioGenero->findOneBy(['id_api' => $idApi]);

            if (!$genero) {
                $genero = new Genero();
                $genero->setIdApi($idApi);
                $genero->setName($nombre);
                $entityManager->persist($genero);
            }

            $listaGenero[$idApi] = $genero;
        }
        $entityManager->flush();
        return $listaGenero;
    }

    private function procesarResultados(array $resultados, EntityManagerInterface $entityManager, array $mapaGeneros): array
    {
        $seriesCreadas = [];
        $repositorioSerie = $entityManager->getRepository(Serie::class);

        foreach ($resultados as $element) {
            $idSerie = $element['id'];
            $serie = $repositorioSerie->findOneBy(['idApi' => $idSerie]);

            $esNueva = false;

            if (!$serie) {
                $serie = new Serie();
                $serie->setIdApi($idSerie);
                $esNueva = true;
            }

            $serie->setOriginalName($element['original_name']);
            $serie->setOverview($element['overview']);
            $serie->setPopularity($element['popularity']);
            $serie->setPosterPath($element['poster_path']);

            if (!empty($element['first_air_date'])) {
                $serie->setFirstAirDate($element['first_air_date']);
            }

            $serie->setName($element['name']);


            if ($esNueva) {
                $serie->setVoteAverage($element['vote_average']);
                $serie->setVoteCount($element['vote_count']);
            }

            if (isset($element['genre_ids']) && is_array($element['genre_ids'])) {
                foreach ($element['genre_ids'] as $idGeneroApi) {
                    if (isset($mapaGeneros[$idGeneroApi])) {
                        $serie->addGenero($mapaGeneros[$idGeneroApi]);
                    }
                }
            }

            $entityManager->persist($serie);
            $seriesCreadas[] = $serie;
        }

        return $seriesCreadas;
    }
}
