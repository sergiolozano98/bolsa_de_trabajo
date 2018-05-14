<?php

namespace OfertasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categoria
 *
 * @ORM\Table(name="categoria")
 * @ORM\Entity(repositoryClass="OfertasBundle\Repository\CategoriaRepository")
 */
class Categoria
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
     * @ORM\Column(name="Categoria", type="string", length=15, nullable=true)
     */
    private $categoria;

     /**
     * @ORM\ManyToMany(targetEntity="Oferta", mappedBy="categorias")
     */
    protected $ofertas;


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
     * Set categoria
     *
     * @param string $categoria
     *
     * @return Categoria
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return string
     */
    public function getCategoria()
    {
        return $this->categoria;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ofertas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add oferta
     *
     * @param \OfertasBundle\Entity\Oferta $oferta
     *
     * @return Categoria
     */
    public function addOferta(\OfertasBundle\Entity\Oferta $oferta)
    {
        $this->ofertas[] = $oferta;

        return $this;
    }

    /**
     * Remove oferta
     *
     * @param \OfertasBundle\Entity\Oferta $oferta
     */
    public function removeOferta(\OfertasBundle\Entity\Oferta $oferta)
    {
        $this->ofertas->removeElement($oferta);
    }

    /**
     * Get ofertas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOfertas()
    {
        return $this->ofertas;
    }
    function __toString()
    {
        return $this->estado;
        return $this->conocimiento;
    }

}
