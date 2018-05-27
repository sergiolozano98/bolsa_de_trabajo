<?php

namespace OfertasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UsuariosBundle\Entity\Usuario;
use EmpresasBundle\Entity\Empresa;

/**
 * Oferta
 *
 * @ORM\Table(name="estudios")
 * @ORM\Entity(repositoryClass="OfertasBundle\Repository\EstudiosRepository")
 */
class Estudios
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
    * @ORM\ManyToMany(targetEntity="Oferta", mappedBy="idiomas")
    */
   protected $ofertas;

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
     * @ORM\Column(name="estudio")
     */
    private $estudio;

    /**
    * @ORM\OneToMany(targetEntity="\OfertasBundle\Entity\Estudios", mappedBy="id_Estudios")
    */
    private $estudios;

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
     * Set $estudio
     *
     * @param string $estudio
     *
     * @return estudio
     */
    public function setestudio($estudio)
    {
        $this->estudio = $estudio;

        return $this;
    }

    /**
     * Get $estudio
     *
     * @return string
     */
    public function getestudio()
    {
        return $this->estudio;
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
        return $this->estudio;
    }

}
