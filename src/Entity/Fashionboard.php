<?php

namespace App\Entity;

use App\Repository\FashionboardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FashionboardRepository::class)
 */
class Fashionboard implements \JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @ORM\ManyToMany (targetEntity="App\Entity\Product",inversedBy="fashionboard",fetch="EAGER")
     */
    protected $products;
    /**
     * @ORM\ManyToOne (targetEntity="App\Entity\User")
     */
    protected $user;
    /**
     * @ORM\ManyToOne  (targetEntity="App\Entity\Fashionbundle")
     */
    protected $fashionbundle;
    /**
     * @var boolean
     * @ORM\Column(name="clientactivation", type="boolean", length=256, nullable=true)
     */
    protected $clientActivation;
    /**
     * @var boolean
     * @ORM\Column(name="adminvalidation", type="boolean", length=256, nullable=true)
     */
    protected $adminValidation;

    /**
     * Fashionboard constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return bool
     */
    public function isClientActivation(): bool
    {
        return $this->clientActivation;
    }

    /**
     * @param bool $clientActivation
     */
    public function setClientActivation(bool $clientActivation): void
    {
        $this->clientActivation = $clientActivation;
    }

    /**
     * @return bool
     */
    public function isAdminValidation(): bool
    {
        return $this->adminValidation;
    }

    /**
     * @param bool $adminValidation
     */
    public function setAdminValidation(bool $adminValidation): void
    {
        $this->adminValidation = $adminValidation;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return ArrayCollection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param ArrayCollection $products
     */
    public function setProducts(ArrayCollection $products): void
    {
        $this->products = $products;
    }

    /**
     * @return mixed
     */
    public function getFashionbundle()
    {
        return $this->fashionbundle;
    }

    /**
     * @param mixed $fashionbundle
     */
    public function setFashionbundle($fashionbundle): void
    {
        $this->fashionbundle = $fashionbundle;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }
    public function jsonSerialize(): array
    {
        return  get_object_vars($this);
    }
}
