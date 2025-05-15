<?php

namespace App\Trait;
use Doctrine\ORM\Mapping as ORM;

trait TimeStampTrait
{
    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $updatedAt = null;

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTime $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    #[ORM\PrePersist]
    public function onPrePersist(){
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTime();

    }

    #[ORM\PreUpdate]
    public function onUpdatePersist(){
        $this->updatedAt = new \DateTime("now");
    }
}