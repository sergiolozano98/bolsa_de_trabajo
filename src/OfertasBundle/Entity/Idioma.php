<?php

namespace OfertasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estado
 *
 * @ORM\Table(name="idioma")
 * @ORM\Entity(repositoryClass="OfertasBundle\Repository\IdiomaRepository")
 */
class Idioma
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
     * @ORM\Column(name="Idioma", type="string")
     */
    private $idioma;

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
    * @ORM\ManyToMany(targetEntity="Oferta", mappedBy="idiomas")
    */
   protected $ofertas;



    /**
     * Get conocimiento
     *
     * @return string
     */
    public function getIdioma()
    {
        return $this->idioma;
    }
    /**
     * Set idioma
     *
     * @param string $idioma
     *
     * @return idioma
     */
    public function setIdioma($idioma)
    {
        $this->idioma = $idioma;

        return $this;
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return Estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
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
        return $this->idioma;
    }

    public function __construct()
    {
        $this->idioma = new \Doctrine\Common\Collections\ArrayCollection();
    }
}
