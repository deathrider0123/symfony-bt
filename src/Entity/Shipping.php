<?php

namespace App\Entity;

use App\Repository\ShippingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShippingRepository::class)
 */
class Shipping
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $mobile_number;

    /**
     * @ORM\Column(type="integer")
     */
    private $pincode;

    /**
     * @ORM\Column(type="integer")
     */
    private $flat_number;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $area;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $town;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="shippings")
     */
    private $user;

 
    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMobileNumber(): ?int
    {
        return $this->mobile_number;
    }

    public function setMobileNumber(int $mobile_number): self
    {
        $this->mobile_number = $mobile_number;

        return $this;
    }

    public function getPincode(): ?int
    {
        return $this->pincode;
    }

    public function setPincode(int $pincode): self
    {
        $this->pincode = $pincode;

        return $this;
    }

    public function getFlatNumber(): ?int
    {
        return $this->flat_number;
    }

    public function setFlatNumber(int $flat_number): self
    {
        $this->flat_number = $flat_number;

        return $this;
    }

    public function getArea(): ?string
    {
        return $this->area;
    }

    public function setArea(?string $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function setTown(?string $town): self
    {
        $this->town = $town;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
   
}
