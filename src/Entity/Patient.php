<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=PatientRepository::class)
 */
class Patient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**   
    * @Assert\NotBlank(message="Le nom ne peut pas être vide.")
     * @Assert\Length(min=2, minMessage="Le nom doit contenir au moins {{ limit }} caractères.")
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
    * @Assert\NotBlank(message="Le prénom ne peut pas être vide.")
     * @Assert\Length(min=2, minMessage="Le prénom doit contenir au moins {{ limit }} caractères.")
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

/**
 * @Assert\Type("\DateTimeInterface", message="La date de naissance n'est pas valide.")
 * @ORM\Column(type="date", nullable=true)
 */
private $dateNaissance;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(pattern="/^(?:\+|00)?[0-9\s.-]{7,20}$/", message="Le numéro de téléphone n'est pas valide.")
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(message="L'email '{{ value }}' n'est pas un email valide.")
     */
    private $email;
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

public function getDateNaissance(): ?\DateTimeInterface
{
    return $this->dateNaissance;
}

public function setDateNaissance(\DateTimeInterface $dateNaissance): self
{
    $this->dateNaissance = $dateNaissance;
    return $this;
}


    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
