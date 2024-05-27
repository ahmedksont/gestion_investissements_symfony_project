<?php
namespace App\Entity;

use App\Entity\User; // Import the User entity
use App\Repository\ConventionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn; // Import JoinColumn annotation
use Doctrine\ORM\Mapping\ManyToOne; // Import ManyToOne annotation

#[ORM\Entity(repositoryClass: ConventionRepository::class)]
class Convention
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateDebut = null;

    #[ORM\OneToOne(inversedBy: 'convention', cascade: ['persist', 'remove'])]
    private ?Projet $codeP = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "conventions")]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $mat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->DateDebut;
    }

    public function setDateDebut(\DateTimeInterface $DateDebut): static
    {
        $this->DateDebut = $DateDebut;

        return $this;
    }

    public function getCodeP(): ?Projet
    {
        return $this->codeP;
    }

    public function setCodeP(?Projet $codeP): static
    {
        $this->codeP = $codeP;

        return $this;
    }

    public function getMat(): ?User
    {
        return $this->mat;
    }

    public function setMat(?User $mat): static
    {
        $this->mat = $mat;

        return $this;
    }

    public function __toString(): string
    {
        // Concatenate all the fields to represent the Convention entity as a string
        return sprintf(
            '%s - %s - %s',
            $this->DateDebut ? $this->DateDebut->format('Y-m-d') : '',
            $this->codeP ? $this->codeP->getLibelleP() : '',
            $this->mat ? $this->mat->getEmail() : ''
        );
    }
}
