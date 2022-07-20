<?php

namespace App\Entity;

use App\Repository\DestinationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DestinationRepository::class)]
class Destination
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 80)]
    private ?string $country = null;

    #[ORM\ManyToMany(targetEntity: Journey::class, mappedBy: 'destinations')]
    private Collection $journeys;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $regions = [];

    public function __construct()
    {
        $this->journeys = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection<int, Journey>
     */
    public function getJourneys(): Collection
    {
        return $this->journeys;
    }

    public function addJourney(Journey $journey): self
    {
        if (!$this->journeys->contains($journey)) {
            $this->journeys[] = $journey;
            $journey->addDestination($this);
        }

        return $this;
    }

    public function removeJourney(Journey $journey): self
    {
        if ($this->journeys->removeElement($journey)) {
            $journey->removeDestination($this);
        }

        return $this;
    }

    public function getRegions(): array
    {
        return $this->regions;
    }

    public function setRegions(?array $regions): self
    {
        $this->regions = $regions;

        return $this;
    }
}
