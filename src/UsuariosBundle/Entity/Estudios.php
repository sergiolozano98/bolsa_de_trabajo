<?php
namespace UsuariosBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Curriculum
 *
 * @ORM\Table(name="Estudios_Candidato")
 * @ORM\Entity(repositoryClass="UsuariosBundle\Repository\Estudios_CandidatoRepository")
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="experiencias")
     * @ORM\JoinColumn(name="id_candidato", referencedColumnName="id")
     */
    private $id_Candidato;

    /**
     * @ORM\ManyToOne(targetEntity="\OfertasBundle\Entity\Estudios", inversedBy="experiencias")
     * @ORM\JoinColumn(name="id_Estudios", referencedColumnName="id")
     */
    private $id_Estudios;
    /**
     * @var string
     * @ORM\Column(name="especialidad", type="string", length=255)
     */
    private $especialidad;

     /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaObtencion", type="datetime")
     */
    private $fechaObtencion;


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
     * Set empresa
     *
     * @param integer $id_Candidato
     *
     * @return id_candidato
     */
    public function setIdEstudios(\OfertasBundle\Entity\Estudios $id_Candidato)
    {
        $this->id_Candidato = $id_Candidato;
        return $this;
    }
    /**
     * Get id_candidato
     *
     * @return int
     */
    public function getIdEstudios()
    {
        return $this->id_Candidato;
    }


    /**
     * Get the value of Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Get the value of Especialidad
     *
     * @return string
     */
    public function getEspecialidad()
    {
        return $this->especialidad;
    }

    /**
     * Set the value of Especialidad
     *
     * @param string especialidad
     *
     * @return self
     */
    public function setEspecialidad($especialidad)
    {
        $this->especialidad = $especialidad;

        return $this;
    }

    /**
     * Get the value of Fecha Obtencion
     *
     * @return \DateTime
     */
    public function getFechaObtencion()
    {
        return $this->fechaObtencion;
    }

    /**
     * Set the value of Fecha Obtencion
     *
     * @param \DateTime fechaObtencion
     *
     * @return self
     */
    public function setFechaObtencion(\DateTime $fechaObtencion)
    {
        $this->fechaObtencion = $fechaObtencion;

        return $this;
    }

}
