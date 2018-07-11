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


}
