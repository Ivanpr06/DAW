<?php

namespace App\Controller;

use App\Entity\Genero;
use App\Entity\Serie;
use App\Entity\Valoracion;
use App\Repository\GeneroRepository;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SerieController extends AbstractController
{
    #[Route('/serie', name: 'app_serie')]
    public function index(SerieRepository $serieRepository, Request $request, GeneroRepository $generoRepository): Response
    {
        $orden = $request->query->get('orden', 'defecto');
        $generoId = $request->query->get('genero', 'todos');

        $consultaDatos = $serieRepository->createQueryBuilder('serie');

        if ($generoId !== 'todos') {
            $consultaDatos->join('serie.generos', 'genero')
                ->andWhere('genero.id = :idBusqueda')
                ->setParameter('idBusqueda', $generoId);
        }

        switch ($orden) {
            case 'nuevas':
                $consultaDatos->orderBy('serie.first_air_date', 'DESC');
                break;
            case 'alfabetico':
                $consultaDatos->orderBy('serie.name', 'ASC');
                break;
            case 'popularidad':
                $consultaDatos->orderBy('serie.popularity', 'DESC');
                break;
            case 'mejorNota':
                $consultaDatos->orderBy('serie.vote_average', 'DESC');
        }

        $series_list = $consultaDatos->getQuery()->getResult();

        $generos = $generoRepository->findAll();

        return $this->render('serie/serie.html.twig', [
            'list_serie' => $series_list,
            'generos' => $generos,
            'orden_actual' => $orden,
            'genero_actual' => $generoId,
        ]);
    }

    #[Route('/serieEspecifica/{id}', name: 'app_serieEspecifica')]
    public function show(Serie $serie): Response
    {
        return $this->render('serie/serieEspecifica.html.twig', [
            'serie' => $serie,
        ]);
    }

    #[Route('/serie/{id}/valoracion', name: 'app_serieValoracion')]
    public function votar(Serie $serie, Request $request, EntityManagerInterface $entityManager): Response
    {
       $notaNueva = $request->request->get('nota');
       $comentarioNuevo = $request->request->get('comentario');
       $usuario = $this->getUser();

        $repositorioValoracion = $entityManager->getRepository(Valoracion::class);
        $valoracion = $repositorioValoracion->findOneBy(['serie' => $serie, 'usuario' => $usuario]);

        $notaActual = $serie->getVoteAverage();
        $cantidadVotosActual = $serie->getVoteCount();

        $puntuacionTotal = $notaActual * $cantidadVotosActual;

        if(!$valoracion){
            $valoracion = new Valoracion();
            $valoracion->setSerie($serie);
            $valoracion->setUsuario($usuario);
            $valoracion->setFecha(new \DateTime('now'));
            $valoracion->setNota($notaNueva);
            $valoracion->setComentario($comentarioNuevo);

            $puntuacionTotal += $notaNueva;
            $cantidadVotosActual++;

            $nuevoPromedio = $puntuacionTotal / $cantidadVotosActual;
        }else{
            $notaAntigua = $valoracion->getNota();

            $valoracion->setNota($notaNueva);
            $valoracion->setComentario($comentarioNuevo);

            $nuevoPromedio = ($puntuacionTotal - $notaAntigua + $notaNueva) / $cantidadVotosActual;
        }

        $entityManager->persist($valoracion);
        $serie->setVoteAverage($nuevoPromedio);
        $serie->setVoteCount($cantidadVotosActual);
        $entityManager->persist($serie);

        $entityManager->flush();

        return $this->redirectToRoute('app_serieEspecifica', ['id' => $serie->getId()]);
    }
}
