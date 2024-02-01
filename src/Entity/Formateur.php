<?php

namespace App\Entity;

use App\Repository\FormateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormateurRepository::class)]
class Formateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\OneToMany(mappedBy: 'id_formateur', targetEntity: Sessions::class)]
    private Collection $id_formation;

    #[ORM\OneToMany(mappedBy: 'idFormateur', targetEntity: Sessions::class, orphanRemoval: true)]
    private Collection $idSession;

    public function __construct()
    {
        $this->id_formation = new ArrayCollection();
        $this->idSession = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Sessions>
     */
    public function getIdSession(): Collection
    {
        return $this->idSession;
    }

    public function addIdSession(Sessions $idSession): static
    {
        if (!$this->idSession->contains($idSession)) {
            $this->idSession->add($idSession);
            $idSession->setIdFormateur($this);
        }

        return $this;
    }

    public function removeIdSession(Sessions $idSession): static
    {
        if ($this->idSession->removeElement($idSession)) {
            // set the owning side to null (unless already changed)
            if ($idSession->getIdFormateur() === $this) {
                $idSession->setIdFormateur(null);
            }
        }

        return $this;
    }


}
