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

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\OneToMany(mappedBy: 'formateur', targetEntity: Session::class)]
    private Collection $formateur;

    public function __construct()
    {
        $this->formateur = new ArrayCollection();
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
     * @return Collection<int, Session>
     */
    public function getFormateur(): Collection
    {
        return $this->formateur;
    }

    public function addFormateur(Session $formateur): static
    {
        if (!$this->formateur->contains($formateur)) {
            $this->formateur->add($formateur);
            $formateur->setFormateur($this);
        }

        return $this;
    }

    public function removeFormateur(Session $formateur): static
    {
        if ($this->formateur->removeElement($formateur)) {
            // set the owning side to null (unless already changed)
            if ($formateur->getFormateur() === $this) {
                $formateur->setFormateur(null);
            }
        }

        return $this;
    }

    public function __tostring(){
        return $this->nom ." " .$this->prenom;

    }
}
