<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $intutituleFormation = null;

    #[ORM\OneToMany(mappedBy: 'formation', targetEntity: Session::class, orphanRemoval: true)]
    private Collection $formation;

    public function __construct()
    {
        $this->formation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntutituleFormation(): ?string
    {
        return $this->intutituleFormation;
    }

    public function setIntutituleFormation(string $intutituleFormation): static
    {
        $this->intutituleFormation = $intutituleFormation;

        return $this;
    }

    /**
     * @return Collection<int, Session>
     */
    public function getFormation(): Collection
    {
        return $this->formation;
    }

    public function addFormation(Session $formation): static
    {
        if (!$this->formation->contains($formation)) {
            $this->formation->add($formation);
            $formation->setFormation($this);
        }

        return $this;
    }

    public function removeFormation(Session $formation): static
    {
        if ($this->formation->removeElement($formation)) {
            // set the owning side to null (unless already changed)
            if ($formation->getFormation() === $this) {
                $formation->setFormation(null);
            }
        }

        return $this;
    }
}
