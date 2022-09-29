<?php

namespace App\Entity;

use App\Repository\PersonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonRepository::class)]
class Person
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $firstname = null;

    #[ORM\Column(length: 50)]
    private ?string $lastname = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $birthDate = null;

    #[ORM\OneToMany(mappedBy: 'person', targetEntity: MoviePerson::class)]
    private Collection $moviePeople;

    public function __construct()
    {
        $this->moviePeople = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * @return Collection<int, MoviePerson>
     */
    public function getMoviePeople(): Collection
    {
        return $this->moviePeople;
    }

    public function addMoviePerson(MoviePerson $moviePerson): self
    {
        if (!$this->moviePeople->contains($moviePerson)) {
            $this->moviePeople->add($moviePerson);
            $moviePerson->setPerson($this);
        }

        return $this;
    }

    public function removeMoviePerson(MoviePerson $moviePerson): self
    {
        if ($this->moviePeople->removeElement($moviePerson)) {
            // set the owning side to null (unless already changed)
            if ($moviePerson->getPerson() === $this) {
                $moviePerson->setPerson(null);
            }
        }

        return $this;
    }
}
