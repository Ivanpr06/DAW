<?php

namespace App\Entity;

use App\Repository\RankingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;

#[ORM\Entity(repositoryClass: RankingRepository::class)]
#[ORM\Table(name: 'ranking', schema: 'CN_API')]
class Ranking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ManyToOne(targetEntity: Categoria::class)]
    #[JoinColumn(name: 'id_categoria', referencedColumnName: 'id')]
    private ?Categoria $categoria = null;

    #[ManyToOne(targetEntity: Usuario::class)]
    #[JoinColumn(name: 'id_usuario', referencedColumnName: 'id')]
    private ?Usuario $usuario = null;

    /**
     * @var Collection<int, RankingSerie>
     */
    #[OneToMany(targetEntity: RankingSerie::class, mappedBy: 'ranking')]
    private Collection $rankingSeries;

    public function __construct()
    {
        $this->rankingSeries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): static
    {
        $this->categoria = $categoria;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usario): static
    {
        $this->usuario = $usario;

        return $this;
    }

    /**
     * @return Collection<int, RankingSerie>
     */
    public function getRankingSeries(): Collection
    {
        return $this->rankingSeries;
    }

    public function addRankingSeries(RankingSerie $rankingSeries): static
    {
        if (!$this->rankingSeries->contains($rankingSeries)) {
            $this->rankingSeries->add($rankingSeries);
            $rankingSeries->setRanking($this);
        }

        return $this;
    }

    public function removeRankingSeries(RankingSerie $rankingSeries): static
    {
        if ($this->rankingSeries->removeElement($rankingSeries)) {
            // set the owning side to null (unless already changed)
            if ($rankingSeries->getRanking() === $this) {
                $rankingSeries->setRanking(null);
            }
        }

        return $this;
    }
}
