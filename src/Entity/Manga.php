<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MangaRepository")
 */
class Manga
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $short_description;

    /**
     * @ORM\Column(type="text")
     */
    private $long_description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $main_image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $secondary1_image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $secondary2_image;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category", inversedBy="mangas")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Review", mappedBy="manga")
     */
    private $reviews;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrderManga", mappedBy="manga", orphanRemoval=true)
     */
    private $orderMangas;

   

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->orderMangas = new ArrayCollection();
        
    }
    public function __toString(){
        return $this->title;
     }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->short_description;
    }

    public function setShortDescription(string $short_description): self
    {
        $this->short_description = $short_description;

        return $this;
    }

    public function getLongDescription(): ?string
    {
        return $this->long_description;
    }

    public function setLongDescription(string $long_description): self
    {
        $this->long_description = $long_description;

        return $this;
    }

    public function getMainImage(): ?string
    {
        return $this->main_image;
    }

    public function setMainImage(string $main_image): self
    {
        $this->main_image = $main_image;

        return $this;
    }

    public function getSecondary1Image(): ?string
    {
        return $this->secondary1_image;
    }

    public function setSecondary1Image(string $secondary1_image): self
    {
        $this->secondary1_image = $secondary1_image;

        return $this;
    }

    public function getSecondary2Image(): ?string
    {
        return $this->secondary2_image;
    }

    public function setSecondary2Image(string $secondary2_image): self
    {
        $this->secondary2_image = $secondary2_image;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function setCategories(array $categories)
    {
        return $this->categories = $categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
        }

        return $this;
    }

    /**
     * @return Collection|Review[]
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews[] = $review;
            $review->setManga($this);
        }

        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->reviews->contains($review)) {
            $this->reviews->removeElement($review);
            // set the owning side to null (unless already changed)
            if ($review->getManga() === $this) {
                $review->setManga(null);
            }
        }

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
            $orderManga->setManga($this);
        }

        return $this;
    }

    public function removeOrderManga(OrderManga $orderManga): self
    {
        if ($this->orderMangas->contains($orderManga)) {
            $this->orderMangas->removeElement($orderManga);
            // set the owning side to null (unless already changed)
            if ($orderManga->getManga() === $this) {
                $orderManga->setManga(null);
            }
        }

        return $this;
    }

   
}
