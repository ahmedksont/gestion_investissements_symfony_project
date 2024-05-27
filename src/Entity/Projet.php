<?php
namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $LibelleP = null;

    #[ORM\Column(length: 255)]
    private ?string $SecteurP = null;

    #[ORM\Column]
    private ?float $CoutFixe = null;

    #[ORM\Column(length: 255)]
    private ?string $CoutVar = null;

    #[ORM\Column]
    private ?int $DureeP = null;


    #[ORM\OneToOne(mappedBy: 'codeP', cascade: ['persist', 'remove'])]
    private ?Convention $convention = null;

    #[ORM\Column(length: 255)]
    private ?string $PictureUrl = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleP(): ?string
    {
        return $this->LibelleP;
    }

    public function setLibelleP(string $LibelleP): static
    {
        $this->LibelleP = $LibelleP;

        return $this;
    }

    public function getSecteurP(): ?string
    {
        return $this->SecteurP;
    }


    public function setSecteurP(string $SecteurP): static
    {
        $this->SecteurP = $SecteurP;

        return $this;
    }

    public function getCoutFixe(): ?float
    {
        return $this->CoutFixe;
    }

    public function setCoutFixe(float $CoutFixe): static
    {
        $this->CoutFixe = $CoutFixe;

        return $this;
    }

    public function getCoutVar(): ?string
    {
        return $this->CoutVar;
    }

    public function setCoutVar(string $CoutVar): static
    {
        $this->CoutVar = $CoutVar;

        return $this;
    }

    public function getDureeP(): ?int
    {
        return $this->DureeP;
    }

    public function setDureeP(int $DureeP): static
    {
        $this->DureeP = $DureeP;

        return $this;
    }

    public function getConvention(): ?Convention
    {
        return $this->convention;
    }

    public function setConvention(?Convention $convention): static
    {
        // unset the owning side of the relation if necessary
        if ($convention === null && $this->convention !== null) {
            $this->convention->setCodeP(null);
        }

        // set the owning side of the relation if necessary
        if ($convention !== null && $convention->getCodeP() !== $this) {
            $convention->setCodeP($this);
        }

        $this->convention = $convention;

        return $this;
    }

    public function __toString(): string
    {
        // Concatenate all the fields to represent the Projet entity as a string
        return sprintf(
            'ID: %s, LibelleP: %s, SecteurP: %s, CoutFixe: %s, CoutVar: %s, DureeP: %s',
            $this->id,
            $this->LibelleP,
            $this->SecteurP,
            $this->CoutFixe,
            $this->CoutVar,
            $this->DureeP,
            $this->PictureUrl
        );
    }

    public function getPictureUrl(): ?string
    {
        return $this->PictureUrl;
    }

    public function setPictureUrl(string $PictureUrl): static
    {
        $this->PictureUrl = $PictureUrl;

        return $this;
    }
}
