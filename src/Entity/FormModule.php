<?php

namespace App\Entity;

use App\Repository\FormModuleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormModuleRepository::class)]
class FormModule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomModule = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomModule(): ?string
    {
        return $this->nomModule;
    }

    public function setNomModule(string $nomModule): static
    {
        $this->nomModule = $nomModule;

        return $this;
    }
}
