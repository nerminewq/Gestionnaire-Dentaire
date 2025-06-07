<?php

namespace App\Entity;

use App\Repository\TraitementRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TraitementRepository::class)
 */
class Traitement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="La description ne peut pas être vide.")
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     * @Assert\NotBlank(message="Le coût ne peut pas être vide.")
     * @Assert\PositiveOrZero(message="Le coût doit être un nombre positif ou zéro.")
     */
    private $cout;

    /**
     * @ORM\Column(type="date") 
     * @Assert\NotBlank(message="La date du traitement ne peut pas être vide.")
     * @Assert\Type("\DateTimeInterface", message="La date du traitement n'est pas valide.")
     */
    private $dateTraitement;

    /**
     * @ORM\ManyToOne(targetEntity=Patient::class)
     * @ORM\JoinColumn(nullable=false) 
     * @Assert\NotBlank(message="Le patient est requis.")
     */
    private $patient;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Le statut est requis.")
     * @Assert\Choice({"Proposé", "En cours", "Terminé", "Annulé"}, message="Choisissez un statut valide.")
     */
    private $statut;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCout(): ?string
    {
        return $this->cout;
    }

    public function setCout(string $cout): self
    {
        $this->cout = $cout;

        return $this;
    }

    public function getDateTraitement(): ?\DateTimeInterface
    {
        return $this->dateTraitement;
    }

    public function setDateTraitement(\DateTimeInterface $dateTraitement): self
    {
        $this->dateTraitement = $dateTraitement;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }
}
