<?php

namespace App\Entity;

use App\Repository\SerieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;

#[ORM\Entity(repositoryClass: SerieRepository::class)]
#[ORM\Table(name: 'serie', schema: 'CN_API')]

class Serie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: "idApi")]
    private ?int $idApi = null;

    #[ORM\Column(name:"original_name", length: 255)]
    private ?string $original_name = null;

    #[ORM\Column(name: "overview", type: Types::TEXT)]
    private ?string $overview = null;

    #[ORM\Column(name: "popularity")]
    private ?float $popularity = null;

    #[ORM\Column(name: "poster_path",length: 500)]
    private ?string $poster_path = null;

    #[ORM\Column(name: "first_air_date", length: 255)]
    private ?string $first_air_date = null;

    #[ORM\Column(name: "name", length: 255)]
    private ?string $name = null;

    #[ORM\Column(name: "vote_average")]
    private ?float $vote_average = null;

    #[ORM\Column(name: "vote_count")]
    private ?int $vote_count = null;

    /**
     * @var Collection<int, Valoracion>
     */
    #[OneToMany(targetEntity: Valoracion::class, mappedBy: 'serie')]
    private Collection $valoraciones;

    /**
     * @var Collection<int, Genero>
     */
    #[ManyToMany(targetEntity: Genero::class, inversedBy: 'serie')]
    #[JoinTable(name: 'serie_genero')]
    private Collection $generos;

    /**
     * @var Collection<int, Categoria>
     */
    #[ManyToMany(targetEntity: Categoria::class, inversedBy: 'serie')]
    #[JoinTable(name: 'serie_categoria')]
    #[ORM\JoinColumn(name: 'id_serie', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'id_categoria', referencedColumnName: 'id')]
    private Collection $categorias;

    /**
     * @var Collection<int, RankingSerie>
     */
    #[OneToMany(targetEntity: RankingSerie::class, mappedBy: 'serie')]
    private Collection $rankingSeries;

    public function __construct()
    {
        $this->valoraciones = new ArrayCollection();
        $this->generos = new ArrayCollection();
        $this->categorias = new ArrayCollection();
        $this->rankingSeries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOriginalName(): ?string
    {
        return $this->original_name;
    }

    public function setOriginalName(string $original_name): static
    {
        $this->original_name = $original_name;

        return $this;
    }

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function setOverview(string $overview): static
    {
        $this->overview = $overview;

        return $this;
    }

    public function getPopularity(): ?float
    {
        return $this->popularity;
    }

    public function setPopularity(float $popularity): static
    {
        $this->popularity = $popularity;

        return $this;
    }

    public function getPosterPath(): ?string
    {
        return $this->poster_path;
    }

    public function setPosterPath(?string $poster_path): static
    {
        $this->poster_path = $poster_path;

        return $this;
    }

    public function getFirstAirDate(): ?string
    {
        return $this->first_air_date;
    }

    public function setFirstAirDate(string $first_air_date): static
    {
        $this->first_air_date = $first_air_date;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getVoteAverage(): ?float
    {
        return $this->vote_average;
    }

    public function setVoteAverage(float $vote_average): static
    {
        $this->vote_average = $vote_average;

        return $this;
    }

    public function getVoteCount(): ?int
    {
        return $this->vote_count;
    }

    public function setVoteCount(int $vote_count): static
    {
        $this->vote_count = $vote_count;

        return $this;
    }

    /**
     * @return Collection<int, Valoracion>
     */
    public function getValoraciones(): Collection
    {
        return $this->valoraciones;
    }

    public function addValoracione(Valoracion $valoracione): static
    {
        if (!$this->valoraciones->contains($valoracione)) {
            $this->valoraciones->add($valoracione);
            $valoracione->setSerie($this);
        }

        return $this;
    }

    public function removeValoracione(Valoracion $valoracione): static
    {
        if ($this->valoraciones->removeElement($valoracione)) {
            // set the owning side to null (unless already changed)
            if ($valoracione->getSerie() === $this) {
                $valoracione->setSerie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Genero>
     */
    public function getGeneros(): Collection
    {
        return $this->generos;
    }

    public function addGenero(Genero $genero): static
    {
        if (!$this->generos->contains($genero)) {
            $this->generos->add($genero);
            $genero->addSerie($this);
        }

        return $this;
    }

    public function removeGenero(Genero $genero): static
    {
        if ($this->generos->removeElement($genero)) {
            $genero->removeSerie($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Categoria>
     */
    public function getCategorias(): Collection
    {
        return $this->categorias;
    }

    public function addCategoria(Categoria $categoria): static
    {
        if (!$this->categorias->contains($categoria)) {
            $this->categorias->add($categoria);
            $categoria->addSerie($this);
        }

        return $this;
    }

    public function removeCategoria(Categoria $categoria): static
    {
        if ($this->categorias->removeElement($categoria)) {
            $categoria->removeSerie($this);
        }

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
            $rankingSeries->setSerie($this);
        }

        return $this;
    }

    public function removeRankingSeries(RankingSerie $rankingSeries): static
    {
        if ($this->rankingSeries->removeElement($rankingSeries)) {
            // set the owning side to null (unless already changed)
            if ($rankingSeries->getSerie() === $this) {
                $rankingSeries->setSerie(null);
            }
        }

        return $this;
    }

    public function getIdApi(): ?int
    {
        return $this->idApi;
    }

    public function setIdApi(int $idApi): static
    {
        $this->idApi = $idApi;

        return $this;
    }
}
