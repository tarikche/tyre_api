<?php

namespace App\Entity;

use App\Repository\TyreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TyreRepository::class)]
class Tyre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
