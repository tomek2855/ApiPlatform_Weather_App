<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CityRepository::class)
 */
class City
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=WeatherRecord::class, mappedBy="city", orphanRemoval=true)
     */
    private $weatherRecords;

    public function __construct()
    {
        $this->weatherRecords = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|WeatherRecord[]
     */
    public function getWeatherRecords(): Collection
    {
        return $this->weatherRecords;
    }

    public function addWeatherRecord(WeatherRecord $weatherRecord): self
    {
        if (!$this->weatherRecords->contains($weatherRecord)) {
            $this->weatherRecords[] = $weatherRecord;
            $weatherRecord->setCity($this);
        }

        return $this;
    }

    public function removeWeatherRecord(WeatherRecord $weatherRecord): self
    {
        if ($this->weatherRecords->removeElement($weatherRecord)) {
            // set the owning side to null (unless already changed)
            if ($weatherRecord->getCity() === $this) {
                $weatherRecord->setCity(null);
            }
        }

        return $this;
    }
}
