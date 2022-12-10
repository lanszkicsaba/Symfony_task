<?php

namespace App\Entity;

use App\Repository\UserTestRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserTestRepository::class)]
class UserTest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    # @Assert\NotBlank
    private ?string $name = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $gender = null;

    #[ORM\Column(length: 100)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $aboutMe = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $isActive = null;

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

    public function getGender(): ?int
    {
        return $this->gender;
    }

    public function setGender(int $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getAboutMe(): ?string
    {
        return $this->aboutMe;
    }

    public function setAboutMe(string $aboutMe): self
    {
        $this->aboutMe = $aboutMe;

        return $this;
    }

    public function getIsActive(): ?int
    {
        return $this->isActive;
    }

    public function setIsActive(int $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }
}
