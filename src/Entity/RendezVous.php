<?php

namespace App\Entity;

use App\Repository\RendezVousRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=RendezVousRepository::class)
 */
class RendezVous
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="La date ne peut pas être vide.")
     * @Assert\Type("\DateTimeInterface", message="La date n'est pas valide.")
     * @Assert\GreaterThanOrEqual("today", message="La date du rendez-vous ne peut pas être dans le passé.")
     */
    private $dateRdv;

    /**
     * @ORM\Column(type="time")
     * @Assert\NotBlank(message="L'heure ne peut pas être vide.")
     * @Assert\Type("\DateTimeInterface", message="L'heure n'est pas valide.")
     */
    private $heureRdv;

    /**
     * @ORM\ManyToOne(targetEntity=Patient::class)
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Le patient est requis.")
     */
    private $patient;


    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $motif;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Le statut est requis.")
     * @Assert\Choice({"Planifié", "Confirmé", "Annulé", "Réalisé"}, message="Choisissez un statut valide.")
     */
    private $statut; // Ex: Planifié, Confirmé, Annulé, Réalisé

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateRdv(): ?\DateTimeInterface
    {
        return $this->dateRdv;
    }

    public function setDateRdv(\DateTimeInterface $dateRdv): self
    {
        $this->dateRdv = $dateRdv;
        return $this;
    }

    public function getHeureRdv(): ?\DateTimeInterface
    {
        return $this->heureRdv;
    }

    public function setHeureRdv(\DateTimeInterface $heureRdv): self
    {
        $this->heureRdv = $heureRdv;
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
    public function getMotif(): ?string
    {
        return $this->motif;
    }

    public function setMotif(?string $motif): self
    {
        $this->motif = $motif;
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

