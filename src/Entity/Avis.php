<?php

namespace App\Entity;

use App\Repository\AvisRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AvisRepository::class)]
class Avis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    #[Assert\Email(message: 'The email {{ value }} is not a valid email.')]
    protected $email;

    #[ORM\Column(length: 255)]
    private string $pseudo;

    #[Assert\GreaterThan(0)]
    #[Assert\When(expression: 'this.type == "percent"',constraints: [new Assert\LessThanOrEqual(100, message: 'The value should be between 1 and 100!')],)]
    private ?int $note;

    #[ORM\Column(type: 'text')]
    private string $commentaire;

    #[ORM\Column()]
    private string $picture;

    /**
     * @var string A "Y-m-d H:i:s" formatted value
     */
    #[Assert\DateTime]
    private $createdAt;

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }
}
