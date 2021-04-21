<?php

namespace App\Entity;

use App\Repository\FashionbundleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=FashionbundleRepository::class)
 */
class Fashionbundle implements \JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Fashionbundle constructor.
     */
    public function __construct()
    {
    }

    public function getId(): int
    {
        return $this->id;
    }
    /**
     * @var int
     * @Assert\NotBlank
     * @Assert\Positive
     * @ORM\Column(name="fashionbordern", type="integer", nullable=true)
     */
    private $fashionbordernumber;
    /**
     *
     * @ORM\Column(name="nom", type="string", length=256, nullable=true)
     */
    private $nom;

    /**
     *
     * @ORM\Column(name="description", type="string", length=256, nullable=true)
     */
    private $description;
    /**
     * @var boolean
     * @ORM\Column(name="promotionstatus", type="boolean", length=256, nullable=true)
     */
    private $promotionstatus;
    /**
     * @var int
     * @Assert\Positive
     * @ORM\Column(name="promotion", type="integer", nullable=true)     */
    private $promotion;
    /**
     * @var float
     * @Assert\NotBlank
     * @Assert\Positive
     * @ORM\Column(name="price", type="float", nullable=true)     */
    private $price;

    /**
     * @return int|null
     */

    public function getFashionbordernumber(): ?int
    {
        return $this->fashionbordernumber;
    }

    /**
     * @param int $fashionbordernumber
     */
    public function setFashionbordernumber(int $fashionbordernumber): void
    {
        $this->fashionbordernumber = $fashionbordernumber;
    }
    /**
     * @return int|null
     */
    public function  getfashionbordern():?int{
        return  $this->fashionbordernumber;
    }
    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
    /**
     * @return string|null
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return bool|null
     */
    public function isPromotionstatus(): ?bool
    {
        return $this->promotionstatus;
    }

    /**
     * @param bool $promotionstatus
     */
    public function setPromotionstatus(bool $promotionstatus): void
    {
        $this->promotionstatus = $promotionstatus;
    }

    /**
     * @return int|null
     */
    public function getPromotion(): ?int
    {
        return $this->promotion;
    }

    /**
     * @param int $promotion
     */
    public function setPromotion(int $promotion): void
    {
        $this->promotion = $promotion;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
    public function jsonSerialize()
    {
        return (object) get_object_vars($this);
    }
}
