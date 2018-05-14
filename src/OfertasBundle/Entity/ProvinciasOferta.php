<?php

namespace OfertasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProvinciasOferta
 *
 * @ORM\Table(name="provincias_oferta")
 * @ORM\Entity(repositoryClass="OfertasBundle\Repository\ProvinciasOfertaRepository")
 */
class ProvinciasOferta
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
     * @ORM\Column(name="provincia", type="string", length=22)
     */
    private $provincia;


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
     * Set provincia
     *
     * @param string $provincia
     *
     * @return ProvinciasOferta
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return string
     */
    public function getProvincia()
    {
        return $this->provincia;
    }
    
    function __toString()
    {
        return $this->provincia;
    }
}

