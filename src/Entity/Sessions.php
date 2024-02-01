<?php

namespace App\Entity;

use App\Repository\SessionsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionsRepository::class)]
class Sessions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column]
    private ?int $nbPlace = null;

    #[ORM\Column(length: 255)]
    private ?string $intitule = null;

    #[ORM\ManyToOne(inversedBy: 'id_formation')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Formateur $id_formateur = null;

    #[ORM\ManyToOne(inversedBy: 'idSession')]
    #[ORM\JoinColumn(nullable: false)]
    private ?formateur $idFormateur = null;

    #[ORM\ManyToOne(inversedBy: 'idSession')]
    #[ORM\JoinColumn(nullable: false)]
    private ?formation $idFormation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getNbPlace(): ?int
    {
        return $this->nbPlace;
    }

    public function setNbPlace(int $nbPlace): static
    {
        $this->nbPlace = $nbPlace;

        return $this;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): static
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getIdFormateur(): ?Formateur
    {
        return $this->id_formateur;
    }

    public function setIdFormateur(?Formateur $id_formateur): static
    {
        $this->id_formateur = $id_formateur;

        return $this;
    }

    public function getIdFormation(): ?formation
    {
        return $this->idFormation;
    }

    public function setIdFormation(?formation $idFormation): static
    {
        $this->idFormation = $idFormation;

        return $this;
    }
}
