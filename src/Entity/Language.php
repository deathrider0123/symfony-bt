<?php

namespace App\Entity;

use App\Repository\LanguageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LanguageRepository::class)
 */
class Language
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $Code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Label;

    /**
     * @ORM\OneToMany(targetEntity=ReviewDetails::class, mappedBy="language")
     */
    private $reviewDetails;

    /**
     * @ORM\OneToMany(targetEntity=Category::class, mappedBy="language")
     */
    private $categories;

    public function __construct()
    {
        $this->reviewDetails = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->Code;
    }

    public function setCode(string $Code): self
    {
        $this->Code = $Code;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->Label;
    }

    public function setLabel(string $Label): self
    {
        $this->Label = $Label;

        return $this;
    }

    /**
     * @return Collection|ReviewDetails[]
     */
    public function getReviewDetails(): Collection
    {
        return $this->reviewDetails;
    }

    public function addReviewDetail(ReviewDetails $reviewDetail): self
    {
        if (!$this->reviewDetails->contains($reviewDetail)) {
            $this->reviewDetails[] = $reviewDetail;
            $reviewDetail->setLanguage($this);
        }

        return $this;
    }

    public function removeReviewDetail(ReviewDetails $reviewDetail): self
    {
        if ($this->reviewDetails->contains($reviewDetail)) {
            $this->reviewDetails->removeElement($reviewDetail);
            // set the owning side to null (unless already changed)
            if ($reviewDetail->getLanguage() === $this) {
                $reviewDetail->setLanguage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setLanguage($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
            // set the owning side to null (unless already changed)
            if ($category->getLanguage() === $this) {
                $category->setLanguage(null);
            }
        }

        return $this;
    }
}
