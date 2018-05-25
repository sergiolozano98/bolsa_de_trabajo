<?php

namespace OfertasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UsuariosBundle\Entity\Usuario;
use EmpresasBundle\Entity\Empresa;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Oferta
 *
 * @ORM\Table(name="conocimientos")
 * @ORM\Entity(repositoryClass="OfertasBundle\Repository\ConocimientosRepository")
 */
class Conocimientos
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
     * @ORM\Column(name="conocimiento", type="string")
     * @ORM\ManyToMany(targetEntity="Oferta", inversedBy="conocimiento")
     * @ORM\JoinColumn(name="conocimiento", referencedColumnName="id")
     */
   private $conocimiento;

    /**
     * @var boolean
     *
     * @ORM\Column(name="requerido", type="boolean")
     */
    private $requerido;

    /**
     * @var boolean
     *
     * @ORM\Column(name="valorado", type="boolean")
     */
    private $valorado;

    /**
     * @var string
     *
     * @ORM\Column(name="nivel")
     */
    private $nivel;

    /**
    * @ORM\ManyToMany(targetEntity="Oferta", mappedBy="conocimientos")
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
     * Set conocimiento
     *
     * @param string $conocimiento
     *
     * @return conocimiento
     */
    public function setConocimiento($conocimiento)
    {
        $this->conocimiento = $conocimiento;

        return $this;
    }

    /**
     * Get conocimiento
     *
     * @return string
     */
    public function getConocimiento()
    {
        return $this->conocimiento;
    }

    /**
     * Set requerido
     *
     * @param boolean $requerido
     *
     * @return requerido
     */
    public function setRequerido($requerido)
    {
        $this->requerido = $requerido;

        return $this;
    }

    /**
     * Get conocimiento
     *
     * @return boolean
     */
    public function getRequerido()
    {
        return $this->requerido;
    }

    /**
     * Set $valorado
     *
     * @param boolean $valorado
     *
     * @return valorado
     */
    public function setValorado($valorado)
    {
        $this->valorado = $valorado;

        return $this;
    }

    /**
     * Get $valorado
     *
     * @return boolean
     */
    public function getValorado()
    {
        return $this->valorado;
    }

    /**
     * Set $nivel
     *
     * @param string $nivel
     *
     * @return nivel
     */
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;

        return $this;
    }

    /**
     * Get $nivel
     *
     * @return string
     */
    public function getNivel()
    {
        return $this->nivel;
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
        return $this->conocimiento;
    }
    public function __construct()
    {
        $this->conocimiento = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
