<?php

namespace App\Entity;

use App\Repository\RankingSerieRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

#[ORM\Entity(repositoryClass: RankingSerieRepository::class)]
#[ORM\Table(name: 'ranking_serie', schema: 'CN_API')]
class RankingSerie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: "position", length: 10)]
    private ?string $position = null;

    #[ManyToOne(targetEntity: Serie::class)]
    #[JoinColumn(name: 'id_serie', referencedColumnName: 'id')]
    private ?Serie $serie = null;

    #[ManyToOne(targetEntity: Ranking::class)]
    #[JoinColumn(name: 'id_ranking', referencedColumnName: 'id')]
    private ?Ranking $ranking = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getSerie(): ?Serie
    {
        return $this->serie;
    }

    public function setSerie(?Serie $serie): static
    {
        $this->serie = $serie;

        return $this;
    }

    public function getRanking(): ?Ranking
    {
        return $this->ranking;
    }

    public function setRanking(?Ranking $ranking): static
    {
        $this->ranking = $ranking;

        return $this;
    }
}
