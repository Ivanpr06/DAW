<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
#[ORM\Table(name: 'usuario', schema: 'CN_API')]

class Usuario implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: "nombre", length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(name: "correo", length: 255)]
    private ?string $correo = null;

    #[ORM\Column(name: "contrasena", length: 500)]
    private ?string $contrasena = null;

    #[ORM\Column(name: "imagen", length: 255)]
    private ?string $imagen = null;

    #[ORM\Column(name: "rol")]
    private array $rol = [];

    /**
     * @var Collection<int, Valoracion>
     */

    #[OneToMany(targetEntity: Valoracion::class, mappedBy: 'usuario')]
    private Collection $valoraciones;

    /**
     * @var Collection<int, Ranking>
     */
    #[OneToMany(targetEntity: Ranking::class, mappedBy: 'usario')]
    private Collection $rankings;

    public function __construct()
    {
        $this->valoraciones = new ArrayCollection();
        $this->rankings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(string $correo): static
    {
        $this->correo = $correo;

        return $this;
    }

    public function getContrasena(): ?string
    {
        return $this->contrasena;
    }

    public function setContrasena(string $contrasena): static
    {
        $this->contrasena = $contrasena;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(string $imagen): static
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getRol(): ?array
    {
        return $this->rol;
    }

    public function setRol(array $rol): static
    {
        $this->rol = $rol;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->contrasena;
    }

    public function setPassword(string $contrasena): static
    {
        $this->contrasena = $contrasena;

        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->rol;

        $roles[] = 'ROLE_USER';

        return array_unique($roles);
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
            $valoracione->setUsuario($this);
        }

        return $this;
    }

    public function removeValoracione(Valoracion $valoracione): static
    {
        if ($this->valoraciones->removeElement($valoracione)) {
            // set the owning side to null (unless already changed)
            if ($valoracione->getUsuario() === $this) {
                $valoracione->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Ranking>
     */
    public function getRankings(): Collection
    {
        return $this->rankings;
    }

    public function addRanking(Ranking $ranking): static
    {
        if (!$this->rankings->contains($ranking)) {
            $this->rankings->add($ranking);
            $ranking->setUsario($this);
        }

        return $this;
    }

    public function removeRanking(Ranking $ranking): static
    {
        if ($this->rankings->removeElement($ranking)) {
            // set the owning side to null (unless already changed)
            if ($ranking->getUsario() === $this) {
                $ranking->setUsario(null);
            }
        }

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return $this->correo;
    }

    public function eraseCredentials(): void
    {

    }
}
