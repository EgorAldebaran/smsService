<?php

namespace App\Entity;

use App\Repository\CallerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CallerRepository::class)]
class Caller
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $fname = null;

    #[ORM\Column(length: 255)]
    private ?string $lname = null;

    #[ORM\Column]
    private ?float $balance = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFname(): ?string
    {
        return $this->fname;
    }

    public function setFname(string $fname): static
    {
        $this->fname = $fname;

        return $this;
    }

    public function getLname(): ?string
    {
        return $this->lname;
    }

    public function setLname(string $lname): static
    {
        $this->lname = $lname;

        return $this;
    }

    public function getBalance(): ?float
    {
        return $this->balance;
    }

    public function setBalance(float $balance): static
    {
        $this->balance = $balance;

        return $this;
    }

    /*
     * осуществление звонков
     */
    public function startCall($from, $to): void
    {
        
    }
}
