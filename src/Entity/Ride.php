<?php

namespace App\Entity;

use App\Repository\RideRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RideRepository::class)]
class Ride
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $departure = null;

    #[ORM\Column(length: 255)]
    private ?string $destination = null;

    #[ORM\Column]
    private ?int $seats = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $ceated = null;

    #[ORM\OneToMany(mappedBy: 'ride', targetEntity: User::class)]
    private Collection $driver;

    #[ORM\ManyToMany(targetEntity: User::class)]
    private Collection $rules;

    public function __construct()
    {
        $this->driver = new ArrayCollection();
        $this->rules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeparture(): ?string
    {
        return $this->departure;
    }

    public function setDeparture(string $departure): self
    {
        $this->departure = $departure;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getSeats(): ?int
    {
        return $this->seats;
    }

    public function setSeats(int $seats): self
    {
        $this->seats = $seats;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCeated(): ?\DateTimeInterface
    {
        return $this->ceated;
    }

    public function setCeated(\DateTimeInterface $ceated): self
    {
        $this->ceated = $ceated;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getDriver(): Collection
    {
        return $this->driver;
    }

    public function addDriver(User $driver): self
    {
        if (!$this->driver->contains($driver)) {
            $this->driver->add($driver);
            $driver->setRide($this);
        }

        return $this;
    }

    public function removeDriver(User $driver): self
    {
        if ($this->driver->removeElement($driver)) {
            // set the owning side to null (unless already changed)
            if ($driver->getRide() === $this) {
                $driver->setRide(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getRules(): Collection
    {
        return $this->rules;
    }

    public function addRule(User $rule): self
    {
        if (!$this->rules->contains($rule)) {
            $this->rules->add($rule);
        }

        return $this;
    }

    public function removeRule(User $rule): self
    {
        $this->rules->removeElement($rule);

        return $this;
    }
}
