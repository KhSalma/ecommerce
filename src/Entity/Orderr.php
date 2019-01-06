<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 */
class Orderr
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

   

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrderManga", mappedBy="orderr")
     */
    private $orderMangas;

    public function __construct()
    {
        $this->orderMangas = new ArrayCollection();
    }

   


    public function getId(): ?int
    {
        return $this->id;
    }

   

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection|OrderManga[]
     */
    public function getOrderMangas(): Collection
    {
        return $this->orderMangas;
    }

    public function addOrderManga(OrderManga $orderManga): self
    {
        if (!$this->orderMangas->contains($orderManga)) {
            $this->orderMangas[] = $orderManga;
            $orderManga->setOrderr($this);
        }

        return $this;
    }

    public function removeOrderManga(OrderManga $orderManga): self
    {
        if ($this->orderMangas->contains($orderManga)) {
            $this->orderMangas->removeElement($orderManga);
            // set the owning side to null (unless already changed)
            if ($orderManga->getOrderr() === $this) {
                $orderManga->setOrderr(null);
            }
        }

        return $this;
    }

   
}
