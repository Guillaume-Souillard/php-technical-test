<?php

namespace App\Entity;

use App\Repository\RunRepository;
use App\Traits\Converter;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=RunRepository::class)
 */
class Run
{
    use Converter;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="runs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $uid;

    /**
     * @ORM\ManyToOne(targetEntity=RunType::class)
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private $type;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotNull
     */
    private $datetime;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotNull
     */
    private $duration;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotNull
     */
    private $distance;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comment;

    /**
     * @ORM\Column(type="float")
     */
    private $average_speed;

    /**
     * @ORM\Column(type="integer")
     */
    private $average_pace;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUid(): ?User
    {
        return $this->uid;
    }

    public function setUid(?User $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    public function getType(): ?RunType
    {
        return $this->type;
    }

    public function setType(?RunType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

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

    public function getDistance(): ?int
    {
        return $this->distance;
    }

    public function setDistance(int $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return array
     */
    public function getFormatedData(): array {
        return [
            'id' => $this->getId(),
            'type' => $this->getType()->getName(),
            'datetime' => $this->getDatetime()->format(DATE_RFC3339),
            'duration' => $this->getDuration(),
            'duration_minute' => $this->secondToMinute($this->getDuration()),
            'distance' => $this->getDistance(),
            'distance_kilometer' => $this->meterToKilometer($this->getDistance()),
            'average_speed' => $this->getAverageSpeed(),
            'average_pace' => $this->getAveragePace() / 60,
            'comment' => $this->getComment(),
        ];
    }

    /**
     * @return array
     */
    public function getApiFormatedData(): array {
        $data = $this->getFormatedData();
        $data['type'] = [
            'id' => $this->getType()->getId(),
            'name' => $this->getType()->getName(),
        ];

        $data['uid'] = $this->getUid()->getId();

        return $data;
    }

    public function getAverageSpeed(): ?float
    {
        return $this->average_speed;
    }

    public function setAverageSpeed(float $average_speed): self
    {
        $this->average_speed = $average_speed;

        return $this;
    }

    public function getAveragePace(): ?int
    {
        return $this->average_pace;
    }

    public function setAveragePace(int $average_pace): self
    {
        $this->average_pace = $average_pace;

        return $this;
    }
}
