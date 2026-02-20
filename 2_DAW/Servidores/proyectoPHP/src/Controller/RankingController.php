<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Entity\Ranking;
use App\Entity\RankingSerie;
use App\Entity\Serie;
use App\Repository\CategoriaRepository;
use App\Repository\RankingRepository;
use App\Repository\RankingSerieRepository;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RankingController extends AbstractController
{
    #[Route('/ranking', name: 'app_ranking')]
    public function index(CategoriaRepository $repository): Response
    {
        return $this->render('ranking/ranking.html.twig', [
            'categoria_list' => $repository->findAll(),
        ]);
    }

    #[Route('/ranking/{id}', name: 'app_rankingEspecifico')]
    public function rankings(Categoria $categoria, RankingRepository $rankingRepo): Response
    {
        $user = $this->getUser();
        $rankingExistente = null;

        if ($user) {
            $rankingExistente = $rankingRepo->findOneBy([
                'usuario' => $user,
                'categoria' => $categoria
            ]);
        }

        $seriesPorTier = [
            'S' => [], 'A' => [], 'B' => [], 'C' => [], 'D' => []
        ];
        $idsRankeados = [];

        if ($rankingExistente) {
            foreach ($rankingExistente->getRankingSeries() as $rankingSerie) {
                $letra = $rankingSerie->getPosition();

                if (array_key_exists($letra, $seriesPorTier)) {
                    $seriesPorTier[$letra][] = $rankingSerie->getSerie();
                    $idsRankeados[] = $rankingSerie->getSerie()->getId();
                }
            }
        }

        $seriesUnranked = [];
        foreach ($categoria->getSerie() as $serie) {
            if (!in_array($serie->getId(), $idsRankeados)) {
                $seriesUnranked[] = $serie;
            }
        }

        return $this->render('ranking/rankingEspecifico.html.twig', [
            'categoria' => $categoria,
            'ranking' => $rankingExistente,
            'seriesPorTier' => $seriesPorTier,
            'seriesUnranked' => $seriesUnranked
        ]);
    }
    #[Route('/ranking/{id}/guardar', name: 'app_guardarRanking', methods: ['POST'])]
    public function guardarRanking(Request $request, Categoria $categoria, EntityManagerInterface $entityManager, SerieRepository $serieRepository, RankingRepository $rankingRepo, RankingSerieRepository $rankingSerieRepository): Response
    {
        $user = $this->getUser();

        $ranking = $rankingRepo->findOneBy([
            'usuario' => $user,
            'categoria' => $categoria
        ]);

        if (!$ranking) {
            $ranking = new Ranking();
            $ranking->setUsuario($user);
            $ranking->setCategoria($categoria);

            $entityManager->persist($ranking);
            $entityManager->flush();
        }

        $tierDatos = [
            'S' => $request->request->get('tier_s'),
            'A' => $request->request->get('tier_a'),
            'B' => $request->request->get('tier_b'),
            'C' => $request->request->get('tier_c'),
            'D' => $request->request->get('tier_d'),
        ];

        $relacionesAntiguas = $rankingSerieRepository->findBy(['ranking' => $ranking]);
        foreach($relacionesAntiguas as $relacion) {
            $entityManager->remove($relacion);
        }
        $entityManager->flush();

        foreach($tierDatos as $letraTier => $idsString){
            if(empty($idsString)) continue;

            $idsArray = explode(',', $idsString);

            foreach($idsArray as $idSerie) {
                $idSerie = trim($idSerie);
                if(!$idSerie) continue;

                $serie = $serieRepository->find($idSerie);

                if($serie){
                    $rankingSerie = new RankingSerie();
                    $rankingSerie->setSerie($serie);
                    $rankingSerie->setRanking($ranking);

                    if (method_exists($rankingSerie, 'setTier')) {
                        $rankingSerie->setTier($letraTier);
                    } else {
                        $rankingSerie->setPosition($letraTier);
                    }

                    $entityManager->persist($rankingSerie);
                }
            }
        }
        $entityManager->flush();

        return $this->redirectToRoute('app_home', ['id' => $categoria->getId()]);
    }

    #[Route('/ranking/nota/{id}', name: 'app_rankingNota')]
    public function show(Categoria $categoria, RankingRepository $rankingRepository): Response
    {
        $rankings = $rankingRepository->findBy(['categoria' => $categoria]);

        $leaderboard = [];

        $puntosPorTier = [
            'S' => 100,
            'A' => 75,
            'B' => 50,
            'C' => 25,
            'D' => 10
        ];

        foreach ($rankings as $rankingIndividual) {
            foreach ($rankingIndividual->getRankingSeries() as $rankingSerie) {

                $serie = $rankingSerie->getSerie();

                if (!$serie) continue;

                $posicion = $rankingSerie->getPosition();
                $serieId = $serie->getId();

                if (!isset($leaderboard[$serieId])) {
                    $leaderboard[$serieId] = [
                        'serie' => $serie,
                        'puntos' => 0,
                        'votos' => 0
                    ];
                }

                if (isset($puntosPorTier[$posicion])) {
                    $leaderboard[$serieId]['puntos'] += $puntosPorTier[$posicion];
                    $leaderboard[$serieId]['votos']++;
                }
            }
        }

        usort($leaderboard, function ($a, $b) {
            return $b['puntos'] <=> $a['puntos'];
        });

        return $this->render('ranking/rankingNota.html.twig', [
            'categoria' => $categoria,
            'leaderboard' => $leaderboard,
        ]);
    }
}
