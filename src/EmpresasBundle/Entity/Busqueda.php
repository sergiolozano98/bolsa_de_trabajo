<?php

namespace EmpresasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Busqueda
 *
 * @ORM\Table(name="busqueda")
 * @ORM\Entity(repositoryClass="EmpresasBundle\Repository\BusquedaRepository")
 */
class Busqueda
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
     * @ORM\Column(name="CampoBusqueda", type="string", length=255, nullable=true)
     */
    private $campoBusqueda;


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
     * Set campoBusqueda
     *
     * @param string $campoBusqueda
     *
     * @return Busqueda
     */
    public function setCampoBusqueda($campoBusqueda)
    {
        $this->campoBusqueda = $campoBusqueda;

        return $this;
    }

    /**
     * Get campoBusqueda
     *
     * @return string
     */
    public function getCampoBusqueda()
    {
        return $this->campoBusqueda;
    }
}

