<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\WeatherRecordRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=WeatherRecordRepository::class)
 */
class WeatherRecord
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="float")
     */
    private $temp;

    /**
     * @ORM\Column(type="float")
     */
    private $tempFeelsLike;

    /**
     * @ORM\Column(type="integer")
     */
    private $preesure;

    /**
     * @ORM\Column(type="integer")
     */
    private $humidity;

    /**
     * @ORM\Column(type="integer")
     */
    private $visibility;

    /**
     * @ORM\Column(type="float")
     */
    private $windSpeed;

    /**
     * @ORM\Column(type="integer")
     */
    private $windDeg;

    /**
     * @ORM\ManyToOne(targetEntity=City::class, inversedBy="weatherRecords")
     * @ORM\JoinColumn(nullable=false)
     */
    private $city;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getTemp(): ?float
    {
        return $this->temp;
    }

    public function setTemp(float $temp): self
    {
        $this->temp = $temp;

        return $this;
    }

    public function getTempFeelsLike(): ?float
    {
        return $this->tempFeelsLike;
    }

    public function setTempFeelsLike(float $tempFeelsLike): self
    {
        $this->tempFeelsLike = $tempFeelsLike;

        return $this;
    }

    public function getPreesure(): ?int
    {
        return $this->preesure;
    }

    public function setPreesure(int $preesure): self
    {
        $this->preesure = $preesure;

        return $this;
    }

    public function getHumidity(): ?int
    {
        return $this->humidity;
    }

    public function setHumidity(int $humidity): self
    {
        $this->humidity = $humidity;

        return $this;
    }

    public function getVisibility(): ?int
    {
        return $this->visibility;
    }

    public function setVisibility(int $visibility): self
    {
        $this->visibility = $visibility;

        return $this;
    }

    public function getWindSpeed(): ?float
    {
        return $this->windSpeed;
    }

    public function setWindSpeed(float $windSpeed): self
    {
        $this->windSpeed = $windSpeed;

        return $this;
    }

    public function getWindDeg(): ?int
    {
        return $this->windDeg;
    }

    public function setWindDeg(int $windDeg): self
    {
        $this->windDeg = $windDeg;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }
}
