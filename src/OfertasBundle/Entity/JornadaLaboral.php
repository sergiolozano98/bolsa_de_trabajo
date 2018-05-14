<?php

namespace OfertasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * JornadaLaboral
 *
 * @ORM\Table(name="jornada_laboral")
 * @ORM\Entity(repositoryClass="OfertasBundle\Repository\JornadaLaboralRepository")
 */
class JornadaLaboral
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
     * @var string
     *
     * @ORM\Column(name="JornadaLaboral", type="string", length=15)
     */
    private $jornadaLaboral;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set jornadaLaboral
     *
     * @param string $jornadaLaboral
     *
     * @return JornadaLaboral
     */
    public function setJornadaLaboral($jornadaLaboral)
    {
        $this->jornadaLaboral = $jornadaLaboral;

        return $this;
    }

    /**
     * Get jornadaLaboral
     *
     * @return string
     */
    public function getJornadaLaboral()
    {
        return $this->jornadaLaboral;
    }
    
    function __toString()
    {
        return $this->jornadaLaboral;
    }
}

