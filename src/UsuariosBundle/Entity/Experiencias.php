<?php
namespace UsuariosBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Curriculum
 *
 * @ORM\Table(name="Experiencias")
 * @ORM\Entity(repositoryClass="UsuariosBundle\Repository\ExperienciaRepository")
 */
class Experiencias
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="experiencias")
     * @ORM\JoinColumn(name="id_candidato", referencedColumnName="id")
     */
    private $id_Candidato;
    /**
     * @var string
     * @ORM\Column(name="puestoTrabajo", type="string", length=255)
     */
    private $puestoTrabajo;
    /**
     * @var string
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @var string
     * @ORM\Column(name="expecialidad", type="string", length=255)
     */
    private $expecialidad;

    /**
     * @var string
     * @ORM\Column(name="empresa", type="string", length=255)
     */
    private $empresa;

    /**
     * @var string
     * @ORM\Column(name="duracion", type="string", length=255)
     */
    private $duracion;

     /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaFin", type="datetime")
     */
    private $fechaFin;

    /**
    * @var \DateTime
    *
    * @ORM\Column(name="fechaInicio", type="datetime")
    */
   private $fechaInicio;


     /**
     * @var bool
     *
     * @ORM\Column(name="experiencia_sector", type="boolean")
     */
    private $experienciaSector;

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
     * Set empresa
     *
     * @param integer $id_Candidato
     *
     * @return id_candidato
     */
    public function setId_Candidato(User $id_Candidato)
    {
        $this->id_Candidato = $id_Candidato;
        return $this;
    }
    /**
     * Get id_candidato
     *
     * @return int
     */
    public function getId_Candidato()
    {
        return $this->id_Candidato;
    }



    /**
     * Set the value of Id
     *
     * @param int id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    /**
     * Get the value of Descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of Descripcion
     *
     * @param string descripcion
     *
     * @return self
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of Expecialidad
     *
     * @return string
     */
    public function getExpecialidad()
    {
        return $this->expecialidad;
    }

    /**
     * Set the value of Expecialidad
     *
     * @param string expecialidad
     *
     * @return self
     */
    public function setExpecialidad($expecialidad)
    {
        $this->expecialidad = $expecialidad;

        return $this;
    }

    /**
     * Get the value of Empresa
     *
     * @return string
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set the value of Empresa
     *
     * @param string empresa
     *
     * @return self
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get the value of Duracion
     *
     * @return string
     */
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * Set the value of Duracion
     *
     * @param string duracion
     *
     * @return self
     */
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;

        return $this;
    }

    /**
     * Get the value of Fecha Fin
     *
     * @return \DateTime
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set the value of Fecha Fin
     *
     * @param \DateTime fechaFin
     *
     * @return self
     */
    public function setFechaFin(\DateTime $fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get the value of Fecha Inicio
     *
     * @return \DateTime
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set the value of Fecha Inicio
     *
     * @param \DateTime fechaInicio
     *
     * @return self
     */
    public function setFechaInicio(\DateTime $fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get the value of Puesto Trabajo
     *
     * @return string
     */
    public function getPuestoTrabajo()
    {
        return $this->puestoTrabajo;
    }

    /**
     * Set the value of Puesto Trabajo
     *
     * @param string puestoTrabajo
     *
     * @return self
     */
    public function setPuestoTrabajo($puestoTrabajo)
    {
        $this->puestoTrabajo = $puestoTrabajo;

        return $this;
    }

    /**
     * Get the value of Experiencia Sector
     *
     * @return bool
     */
    public function getExperienciaSector()
    {
        return $this->experienciaSector;
    }

    /**
     * Set the value of Experiencia Sector
     *
     * @param bool experienciaSector
     *
     * @return self
     */
    public function setExperienciaSector($experienciaSector)
    {
        $this->experienciaSector = $experienciaSector;

        return $this;
    }

}
