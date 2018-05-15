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
     * @ORM\ManytoOne(targetEntity="Oferta", inversedBy="idioma")
     * @ORM\JoinColumn(name="oferta_id", referencedColumnName="id")
     */
    private $oferta;

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

    function __toString()
    {
        return $this->estado;
    }

}
