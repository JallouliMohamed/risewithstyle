<?php

namespace App\Entity;

use App\Repository\QuizRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuizRepository::class)
 */
class Quiz
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $questionid;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $responseid;
    /**
     * @ORM\ManyToOne (targetEntity="App\Entity\User")
     */
    private $user;
    /**
     * @ORM\ManyToOne (targetEntity="App\Entity\Fashionboard")
     */
    private $fashionboardid;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getQuestionid()
    {
        return $this->questionid;
    }

    /**
     * @param mixed $questionid
     */
    public function setQuestionid($questionid): void
    {
        $this->questionid = $questionid;
    }

    /**
     * @return mixed
     */
    public function getResponseid()
    {
        return $this->responseid;
    }

    /**
     * @param mixed $responseid
     */
    public function setResponseid($responseid): void
    {
        $this->responseid = $responseid;
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

    /**
     * @return mixed
     */
    public function getFashionboardid()
    {
        return $this->fashionboardid;
    }

    /**
     * @param mixed $fashionboardid
     */
    public function setFashionboardid($fashionboardid): void
    {
        $this->fashionboardid = $fashionboardid;
    }

}
