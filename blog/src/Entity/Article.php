<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(
     *  type="string",
     *  length=50,
     * )
     */
    private $title;
    
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $subtitle;
    
    /**
     * @ORM\Column(type="text")
     */
    private $content;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $date;
    
    /**
     * @ORM\Column(
     *  type="string",
     *  length=50,
     * )
     */
    private $author;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return (string) $this->email;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }
    
    public function getContent(): string
    {
        return (string) $this->content;
    }
    
    public function getDate(): \DateTime
    {
        return $this->date;
    }
    
    public function getAuthor(): string
    {
        return (string) $this->author;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function setSubtitle(?string $subtitle): self
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function setDate(\DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }
}