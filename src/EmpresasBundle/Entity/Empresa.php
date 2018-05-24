<?php

namespace EmpresasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Empresa
 *
 * @ORM\Table(name="empresa")
 * @ORM\Entity(repositoryClass="EmpresasBundle\Repository\EmpresaRepository")
 */
class Empresa
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
     * @ORM\Column(name="Nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="Descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="Direccion", type="string", length=255)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="CP", type="string", length=5)
     */
    private $cP;

    /**
     * @var string
     *
     * @ORM\Column(name="Localidad", type="string", length=100)
     */
    private $localidad;


    /**
     * @ORM\ManytoOne(targetEntity="Provincia", inversedBy="empresa")
     * @ORM\JoinColumn(name="provincia_id", referencedColumnName="id")
     */
    private $provincia;

    /**
     * @var int
     *
     * @ORM\Column(name="NumEmpleados", type="integer", nullable=true)
     */
    private $numEmpleados;

    /**
     * @var string
     *
     * @ORM\Column(name="Telefono", type="string", length=15)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="Pais", type="string", length=100)
     */
    private $pais;

    /**
     * @var string
     *
     * @ORM\Column(name="URL", type="string", length=255, nullable=true)
     */
    private $uRL;

    /**
     * @var string
     *
     * @ORM\Column(name="Correo", type="string", length=100, nullable=true)
     */
    private $correo;

    /**
     * @var string
     *
     * @ORM\Column(name="Imagen", type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @var string
     *
     * @ORM\Column(name="CIF", type="string", length=12)
     */
    private $cIF;

    /**
     * @var string
     *
     * @ORM\Column(name="Observaciones", type="string", length=255, nullable=true)
     */
    private $observaciones;

    /**
    * @ORM\OneToMany(targetEntity="UsuariosBundle\Entity\User", mappedBy="empresa")
     */
    private $user;


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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Empresa
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Empresa
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Empresa
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set cP
     *
     * @param string $cP
     *
     * @return Empresa
     */
    public function setCP($cP)
    {
        $this->cP = $cP;

        return $this;
    }

    /**
     * Get cP
     *
     * @return string
     */
    public function getCP()
    {
        return $this->cP;
    }

    /**
     * Set localidad
     *
     * @param string $localidad
     *
     * @return Empresa
     */
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;

        return $this;
    }

    /**
     * Get localidad
     *
     * @return string
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }


    /**
     * Set numEmpleados
     *
     * @param integer $numEmpleados
     *
     * @return Empresa
     */
    public function setNumEmpleados($numEmpleados)
    {
        $this->numEmpleados = $numEmpleados;

        return $this;
    }

    /**
     * Get numEmpleados
     *
     * @return int
     */
    public function getNumEmpleados()
    {
        return $this->numEmpleados;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Empresa
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set pais
     *
     * @param string $pais
     *
     * @return Empresa
     */
    public function setPais($pais)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return string
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set uRL
     *
     * @param string $uRL
     *
     * @return Empresa
     */
    public function setURL($uRL)
    {
        $this->uRL = $uRL;

        return $this;
    }

    /**
     * Get uRL
     *
     * @return string
     */
    public function getURL()
    {
        return $this->uRL;
    }

    /**
     * Set correo
     *
     * @param string $correo
     *
     * @return Empresa
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return string
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     *
     * @return Empresa
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set cIF
     *
     * @param string $cIF
     *
     * @return Empresa
     */
    public function setCIF($cIF)
    {
        $this->cIF = $cIF;

        return $this;
    }

    /**
     * Get cIF
     *
     * @return string
     */
    public function getCIF()
    {
        return $this->cIF;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return Empresa
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set provincia
     *
     * @param \EmpresasBundle\Entity\Provincia $provincia
     *
     * @return Empresa
     */
    public function setProvincia(\EmpresasBundle\Entity\Provincia $provincia = null)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return \EmpresasBundle\Entity\Provincia
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    function __toString()
    {
        return $this->nombre;
    }
}
