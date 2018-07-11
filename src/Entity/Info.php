<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Info
 *
 * @ORM\Table(name="info")
 * @ORM\Entity
 */
class Info
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="commune", type="string", length=45, nullable=true)
     */
    private $commune;

    /**
     * @var string|null
     *
     * @ORM\Column(name="centroidx", type="string", length=19, nullable=true)
     */
    private $centroidx;

    /**
     * @var string|null
     *
     * @ORM\Column(name="centroidy", type="string", length=19, nullable=true)
     */
    private $centroidy;

    /**
     * @var string|null
     *
     * @ORM\Column(name="date", type="string", length=27, nullable=true)
     */
    private $date;

    /**
     * @var string|null
     *
     * @ORM\Column(name="echeance", type="string", length=8, nullable=true)
     */
    private $echeance;

    /**
     * @var string|null
     *
     * @ORM\Column(name="indiceNO2", type="string", length=19, nullable=true)
     */
    private $indiceno2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="indiceO3", type="string", length=18, nullable=true)
     */
    private $indiceo3;

    /**
     * @var string|null
     *
     * @ORM\Column(name="indicePM10", type="string", length=20, nullable=true)
     */
    private $indicepm10;

    /**
     * @var string|null
     *
     * @ORM\Column(name="indiceSO2", type="string", length=19, nullable=true)
     */
    private $indiceso2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="qualiteAir", type="string", length=19, nullable=true)
     */
    private $qualiteair;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommune(): ?string
    {
        return $this->commune;
    }

    public function setCommune(?string $commune): self
    {
        $this->commune = $commune;

        return $this;
    }

    public function getCentroidx(): ?string
    {
        return $this->centroidx;
    }

    public function setCentroidx(?string $centroidx): self
    {
        $this->centroidx = $centroidx;

        return $this;
    }

    public function getCentroidy(): ?string
    {
        return $this->centroidy;
    }

    public function setCentroidy(?string $centroidy): self
    {
        $this->centroidy = $centroidy;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(?string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEcheance(): ?string
    {
        return $this->echeance;
    }

    public function setEcheance(?string $echeance): self
    {
        $this->echeance = $echeance;

        return $this;
    }

    public function getIndiceno2(): ?string
    {
        return $this->indiceno2;
    }

    public function setIndiceno2(?string $indiceno2): self
    {
        $this->indiceno2 = $indiceno2;

        return $this;
    }

    public function getIndiceo3(): ?string
    {
        return $this->indiceo3;
    }

    public function setIndiceo3(?string $indiceo3): self
    {
        $this->indiceo3 = $indiceo3;

        return $this;
    }

    public function getIndicepm10(): ?string
    {
        return $this->indicepm10;
    }

    public function setIndicepm10(?string $indicepm10): self
    {
        $this->indicepm10 = $indicepm10;

        return $this;
    }

    public function getIndiceso2(): ?string
    {
        return $this->indiceso2;
    }

    public function setIndiceso2(?string $indiceso2): self
    {
        $this->indiceso2 = $indiceso2;

        return $this;
    }

    public function getQualiteair(): ?string
    {
        return $this->qualiteair;
    }

    public function setQualiteair(?string $qualiteair): self
    {
        $this->qualiteair = $qualiteair;

        return $this;
    }


}
