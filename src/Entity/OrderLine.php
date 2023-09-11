<?php

namespace App\Entity;

use App\Repository\OrderLineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderLineRepository::class)]
class OrderLine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column]
    private ?float $totalPrice = null;

    #[ORM\OneToMany(mappedBy: 'orderLine', targetEntity: Tyre::class)]
    private Collection $tyre;

    #[ORM\ManyToOne(inversedBy: 'orderLine')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Order $OrderId = null;

    public function __construct()
    {
        $this->tyre = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getTotalPrice(): ?float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(float $totalPrice): static
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * @return Collection<int, tyre>
     */
    public function getTyre(): Collection
    {
        return $this->tyre;
    }

    public function addTyre(tyre $tyre): static
    {
        if (!$this->tyre->contains($tyre)) {
            $this->tyre->add($tyre);
            $tyre->setOrderLine($this);
        }

        return $this;
    }

    public function removeTyre(tyre $tyre): static
    {
        if ($this->tyre->removeElement($tyre)) {
            // set the owning side to null (unless already changed)
            if ($tyre->getOrderLine() === $this) {
                $tyre->setOrderLine(null);
            }
        }

        return $this;
    }

    public function getOrderId(): ?Order
    {
        return $this->OrderId;
    }

    public function setOrderId(?Order $OrderId): static
    {
        $this->OrderId = $OrderId;

        return $this;
    }
}
