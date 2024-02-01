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
    private ?string $intituleFormation = null;

    #[ORM\OneToMany(mappedBy: 'idFormation', targetEntity: Sessions::class, orphanRemoval: true)]
    private Collection $idSession;

    public function __construct()
    {
        $this->idSession = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntituleFormation(): ?string
    {
        return $this->intituleFormation;
    }

    public function setIntituleFormation(string $intituleFormation): static
    {
        $this->intituleFormation = $intituleFormation;

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
            $idSession->setIdFormation($this);
        }

        return $this;
    }

    public function removeIdSession(Sessions $idSession): static
    {
        if ($this->idSession->removeElement($idSession)) {
            // set the owning side to null (unless already changed)
            if ($idSession->getIdFormation() === $this) {
                $idSession->setIdFormation(null);
            }
        }

        return $this;
    }
}
