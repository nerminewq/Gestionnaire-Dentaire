<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=FactureRepository::class)
 */
class Facture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
    * @Assert\NotBlank(message="Le numéro de facture ne peut pas être vide.")
     */
    private $numeroFacture;

    /**
     * @ORM\Column(type="date")
          * @Assert\NotBlank(message="La date de la facture ne peut pas être vide.")
     * @Assert\Type("\DateTimeInterface", message="La date de la facture n'est pas valide.")
     */
    private $dateFacture;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $montantTotal;

    /**
     * @ORM\ManyToOne(targetEntity=Patient::class)
    * @ORM\JoinColumn(nullable=true)
     * @Assert\NotBlank(message="Le patient est requis pour la facture.")
     */
    private $patient;

    /**
     * @ORM\ManyToMany(targetEntity=Traitement::class)
     */
    private $traitements;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Le statut de paiement est requis.")
     * @Assert\Choice({"En attente", "Payée", "Partiellement payée", "Annulée"}, message="Choisissez un statut de paiement valide.")
     */
    private $statutPaiement;

    public function __construct()
    {
        $this->traitements = new ArrayCollection();
        $this->dateFacture = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
        
    }

    public function getNumeroFacture(): ?string
    {
        return $this->numeroFacture;
    }

    public function setNumeroFacture(string $numeroFacture): self
    {
        $this->numeroFacture = $numeroFacture;

        return $this;
    }

    public function getDateFacture(): ?\DateTimeInterface
    {
        return $this->dateFacture;
    }

    public function setDateFacture(\DateTimeInterface $dateFacture): self
    {
        $this->dateFacture = $dateFacture;

        return $this;
    }

    public function getMontantTotal(): ?string
    {
        return $this->montantTotal;
    }

    public function setMontantTotal(string $montantTotal): self
    {
        $this->montantTotal = $montantTotal;

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

    /**
     * @return Collection<int, Traitement>
     */
    public function getTraitements(): Collection
    {
        return $this->traitements;
    }

    public function addTraitement(Traitement $traitement): self
    {
        if (!$this->traitements->contains($traitement)) {
            $this->traitements[] = $traitement;
        }

        return $this;
    }

    public function removeTraitement(Traitement $traitement): self
    {
        $this->traitements->removeElement($traitement);

        return $this;
    }

    public function getStatutPaiement(): ?string
    {
        return $this->statutPaiement;
    }

    public function setStatutPaiement(string $statutPaiement): self
    {
        $this->statutPaiement = $statutPaiement;

        return $this;
    }
    
}
