<?php
// src/Entity/User.php

namespace App\Entity;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\User\UserInterface;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser implements UserInterface,\JsonSerializable
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var string
     * @ORM\Column(name="firstname", type="string", length=256, nullable=true)
     */



    private $firstname;
    /** @ORM\Column(name="facebookid", type="string", length=255, nullable=true) */
    protected $facebookId;
    /** @ORM\Column(name="googleId", type="string", length=255, nullable=true) */
    protected $googleId;
    /**
     * @var string
     * @ORM\Column(name="lastname", type="string", length=256, nullable=true)
     */
    private $lastname;
    /**
     * @var string
     * @ORM\Column(name="address", type="string", length=256, nullable=true)
     */
    private $address;
    /**
     * @var integer
     * @ORM\Column(name="phonenumber", type="integer", length=256, nullable=true)
     */
    private $phonenumber;
    /**
     * @var boolean
     * @ORM\Column(name="state", type="boolean", length=256, nullable=true)
     */
    private $state;
    /**
     * @ORM\Column(type="string")
     */
    private $brochureFilename;

    public function getBrochureFilename()
    {
        return $this->brochureFilename;
    }

    public function setBrochureFilename($brochureFilename)
    {
        $this->brochureFilename = $brochureFilename;

        return $this;
    }
    public function __construct()
    {
        parent::__construct();
        $this->state=false;

        // your own logic
    }

    /**
     * @return string|null
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string| null
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string|null
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return int|null
     */
    public function getPhonenumber()
    {
        return $this->phonenumber;
    }

    /**
     * @param int $phonenumber
     */
    public function setPhonenumber(int $phonenumber): void
    {
        $this->phonenumber = $phonenumber;
    }

    /**
     * @return bool|null
     */
    public function isState()
    {
        return $this->state;
    }

    /**
     * @param bool $state
     */
    public function setState(bool $state): void
    {
        $this->state = $state;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getState(): ?bool
    {
        return $this->state;
    }

    /**
     * @return mixed|null
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * @param mixed $facebookId
     */
    public function setFacebookId($facebookId): void
    {
        $this->facebookId = $facebookId;
    }

    /**
     * @return mixed|null
     */
    public function getGoogleId()
    {
        return $this->googleId;
    }

    /**
     * @param mixed $googleId
     */
    public function setGoogleId($googleId): void
    {
        $this->googleId = $googleId;
    }
    public function jsonSerialize()
    {
        return (object) get_object_vars($this);
    }
}