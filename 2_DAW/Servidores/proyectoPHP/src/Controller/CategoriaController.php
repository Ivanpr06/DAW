<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Repository\CategoriaRepository;
use App\Repository\RankingRepository;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategoriaController extends AbstractController
{
    #[Route('admin/categoria', name: 'app_categoria')]
    public function index(Request $request, SerieRepository $serieRepository, CategoriaRepository $categoriaRepository, EntityManagerInterface $entityManager): Response
    {
        if($request->isMethod('GET')){
            $series = $serieRepository->findAll();
            $categorias = $categoriaRepository->findAll();

            return $this->render('categoria/categorias.html.twig', [
                'series' => $series,
                'categorias' => $categorias,
                'categoria_editar' => null
            ]);
        } else {
            $nueva_categoria = new Categoria();
            $nueva_categoria->setNombre($request->request->get('nombre'));
            $nueva_categoria->setDescripcion($request->request->get('descripcion'));
            $nueva_categoria->setImagen($request->request->get('imagen'));

            $series_elegidas = $request->request->get('series_ids');
            $idSerie_elegidos = [];

            if (!empty($series_elegidas)) {
                $idSerie_elegidos = explode(',', $series_elegidas);
            }

            foreach ($idSerie_elegidos as $idSerie) {
                $serie = $serieRepository->find(trim($idSerie));

                if($serie){
                    $nueva_categoria->addSerie($serie);
                    $serie->addCategoria($nueva_categoria);

                    $entityManager->persist($serie);
                }
            }

            $entityManager->persist($nueva_categoria);
            $entityManager->flush();

            return $this->redirectToRoute('app_categoria');
        }
    }

    #[Route('admin/categoria/eliminar/{id}', name: 'app_categoriaEliminar')]
    public function eliminar(int $id, CategoriaRepository $categoriaRepository, RankingRepository $rankingRepository, EntityManagerInterface $entityManager): Response
    {
        $categoria = $categoriaRepository->find($id);

        $usoEnRankings = $rankingRepository->count(['categoria' => $categoria]);

        if ($usoEnRankings > 0) {
            return $this->redirectToRoute('app_categoria');
        }

        $entityManager->remove($categoria);
        $entityManager->flush();

        return $this->redirectToRoute('app_categoria');
    }

    #[Route('admin/categoria/editar/{id}', name: 'app_categoriaEditar')]
    public function editar(int $id, Request $request, CategoriaRepository $categoriaRepository, SerieRepository $serieRepository, EntityManagerInterface $entityManager): Response
    {
        $categoria = $categoriaRepository->find($id);

        if (!$categoria) {
            throw $this->createNotFoundException('Categoría no encontrada');
        }

        // Procesar Formulario
        if ($request->isMethod('POST')) {
            // 1. Datos básicos
            $categoria->setNombre($request->request->get('nombre'));
            $categoria->setDescripcion($request->request->get('descripcion'));
            $categoria->setImagen($request->request->get('imagen'));

            // 2. Gestión de Series (Lógica Simplificada)
            // Paso A: Limpiamos las relaciones actuales
            foreach ($categoria->getSerie() as $serieActual) {
                $categoria->removeSerie($serieActual);
            }

            // Paso B: Añadimos las nuevas seleccionadas
            $stringIds = $request->request->get('series_ids');

            if (!empty($stringIds)) {
                $idsElegidos = explode(',', $stringIds);

                // Buscamos solo las series que necesitamos (Optimizado)
                $seriesNuevas = $serieRepository->findBy(['id' => $idsElegidos]);

                foreach ($seriesNuevas as $serie) {
                    $categoria->addSerie($serie);
                }
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_categoria');
        }

        // Renderizar Vista
        return $this->render('categoria/categorias.html.twig', [
            'series' => $serieRepository->findAll(),
            'categorias' => $categoriaRepository->findAll(),
            'categoria_editar' => $categoria,
        ]);
    }
}
