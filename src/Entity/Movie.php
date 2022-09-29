<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $title = null;

    #[ORM\Column(length: 50)]
    private ?string $poster = null;

    #[ORM\Column]
    private ?int $duration = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $releaseAt = null;

    #[ORM\ManyToOne(inversedBy: 'movies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Genre $genre = null;

    #[ORM\OneToMany(mappedBy: 'movie', targetEntity: MoviePerson::class)]
    private Collection $moviePeople;

    public function __construct()
    {
        $this->moviePeople = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(string $poster): self
    {
        $this->poster = $poster;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getReleaseAt(): ?\DateTimeInterface
    {
        return $this->releaseAt;
    }

    public function setReleaseAt(\DateTimeInterface $releaseAt): self
    {
        $this->releaseAt = $releaseAt;

        return $this;
    }

    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(?Genre $genre): self
    {
        $this->genre = $genre;

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
            $moviePerson->setMovie($this);
        }

        return $this;
    }

    public function removeMoviePerson(MoviePerson $moviePerson): self
    {
        if ($this->moviePeople->removeElement($moviePerson)) {
            // set the owning side to null (unless already changed)
            if ($moviePerson->getMovie() === $this) {
                $moviePerson->setMovie(null);
            }
        }

        return $this;
    }
}
