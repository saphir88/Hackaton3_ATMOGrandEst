<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Info
 *
 * @ORM\Table(name="info")
 * @ORM\Entity(repositoryClass="App\Repository\InfoRepository")
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
     * @ORM\Column(name="commune", type="string", length=45, nullable=true)
     */
    private $commune;

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

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return null|string
     */
    public function getCentroidx(): ?string
    {
        return $this->centroidx;
    }

    /**
     * @param null|string $centroidx
     */
    public function setCentroidx(?string $centroidx): void
    {
        $this->centroidx = $centroidx;
    }

    /**
     * @return null|string
     */
    public function getCentroidy(): ?string
    {
        return $this->centroidy;
    }

    /**
     * @param null|string $centroidy
     */
    public function setCentroidy(?string $centroidy): void
    {
        $this->centroidy = $centroidy;
    }

    /**
     * @return null|string
     */
    public function getCommune(): ?string
    {
        return $this->commune;
    }

    /**
     * @param null|string $commune
     */
    public function setCommune(?string $commune): void
    {
        $this->commune = $commune;
    }

    /**
     * @return null|string
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * @param null|string $date
     */
    public function setDate(?string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return null|string
     */
    public function getEcheance(): ?string
    {
        return $this->echeance;
    }

    /**
     * @param null|string $echeance
     */
    public function setEcheance(?string $echeance): void
    {
        $this->echeance = $echeance;
    }

    /**
     * @return null|string
     */
    public function getIndiceno2(): ?string
    {
        return $this->indiceno2;
    }

    /**
     * @param null|string $indiceno2
     */
    public function setIndiceno2(?string $indiceno2): void
    {
        $this->indiceno2 = $indiceno2;
    }

    /**
     * @return null|string
     */
    public function getIndiceo3(): ?string
    {
        return $this->indiceo3;
    }

    /**
     * @param null|string $indiceo3
     */
    public function setIndiceo3(?string $indiceo3): void
    {
        $this->indiceo3 = $indiceo3;
    }

    /**
     * @return null|string
     */
    public function getIndicepm10(): ?string
    {
        return $this->indicepm10;
    }

    /**
     * @param null|string $indicepm10
     */
    public function setIndicepm10(?string $indicepm10): void
    {
        $this->indicepm10 = $indicepm10;
    }

    /**
     * @return null|string
     */
    public function getIndiceso2(): ?string
    {
        return $this->indiceso2;
    }

    /**
     * @param null|string $indiceso2
     */
    public function setIndiceso2(?string $indiceso2): void
    {
        $this->indiceso2 = $indiceso2;
    }

    /**
     * @return null|string
     */
    public function getQualiteair(): ?string
    {
        return $this->qualiteair;
    }

    /**
     * @param null|string $qualiteair
     */
    public function setQualiteair(?string $qualiteair): void
    {
        $this->qualiteair = $qualiteair;
    }


}
