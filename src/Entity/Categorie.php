<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomCategorie = null;

    #[ORM\OneToMany(mappedBy: 'id_categorie', targetEntity: FormModule::class, orphanRemoval: true)]
    private Collection $idFormModules;

    public function __construct()
    {
        $this->idFormModules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCategorie(): ?string
    {
        return $this->nomCategorie;
    }

    public function setNomCategorie(string $nomCategorie): static
    {
        $this->nomCategorie = $nomCategorie;

        return $this;
    }

    /**
     * @return Collection<int, FormModule>
     */
    public function getIdFormModules(): Collection
    {
        return $this->idFormModules;
    }

    public function addIdFormModule(FormModule $idFormModule): static
    {
        if (!$this->idFormModules->contains($idFormModule)) {
            $this->idFormModules->add($idFormModule);
            $idFormModule->setIdCategorie($this);
        }

        return $this;
    }

    public function removeIdFormModule(FormModule $idFormModule): static
    {
        if ($this->idFormModules->removeElement($idFormModule)) {
            // set the owning side to null (unless already changed)
            if ($idFormModule->getIdCategorie() === $this) {
                $idFormModule->setIdCategorie(null);
            }
        }

        return $this;
    }
}
