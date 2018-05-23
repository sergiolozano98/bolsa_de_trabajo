<?php

namespace UsuariosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Candidato
 *
 * @ORM\Table(name="candidato")
 * @ORM\Entity(repositoryClass="UsuariosBundle\Repository\CandidatoRepository")
 */
class Candidato
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

     /**
      * @ORM\ManyToOne(targetEntity="OfertasBundle\Entity\Oferta", inversedBy="oferta")
      * @ORM\JoinColumn(name="ofertas_id", referencedColumnName="id")
      */
    private $ofertas;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="candidatos")
     * @ORM\JoinColumn(name="candidato_id", referencedColumnName="id")
     */
    private $candidato;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaInscripcion", type="datetime")
     */
  	private $FechaInscripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaProceso", type="datetime")
     */
    private $FechaProceso;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaAceptado", type="datetime")
     */
    private $FechaAceptado;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaDescartado", type="datetime")
     */
    private $FechaDescartado;
    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Oferta
     */
    public function setFechaInscripcion($FechaInscripcion)
    {
        $this->FechaInscripcion = $FechaInscripcion;
        return $this;
    }
    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFechaInscripcion()
    {
        return $this->FechaInscripcion;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Oferta
     */
    public function setFechaProceso($FechaProceso)
    {
        $this->FechaProceso = $FechaProceso;
        return $this;
    }
    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFechaProceso()
    {
        return $this->FechaProceso;
    }


    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Oferta
     */
    public function setFechaAceptado($FechaAceptado)
    {
        $this->FechaAceptado = $FechaAceptado;
        return $this;
    }
    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFechaAceptado()
    {
        return $this->FechaAceptado;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Oferta
     */
    public function setFechaDescartado($FechaDescartado)
    {
        $this->FechaDescartado = $FechaDescartado;
        return $this;
    }
    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFechaDecartado()
    {
        return $this->FechaDescartado;
    }
    public function __construct()
    {
        $this->candidatos = new ArrayCollection();
    }

  }
