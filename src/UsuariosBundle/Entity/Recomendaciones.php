<?php
namespace UsuariosBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Curriculum
 *
 * @ORM\Table(name="Recomendaciones")
 * @ORM\Entity(repositoryClass="UsuariosBundle\Repository\RecomendacionesRepository")
 */
class Recomendaciones
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="recomendaciones")
     * @ORM\JoinColumn(name="id_candidato", referencedColumnName="id")
     */
    private $id_Candidato;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="usuariosempresas")
     * @ORM\JoinColumn(name="id_UsuarioEmpresas", referencedColumnName="id")
     */
    private $id_UsuarioEmpresas;

    /**
     * @var boolean
     * @ORM\Column(name="visualizarse", type="boolean")
     */
    private $visualizarse;
    /**
     * @var string
     * @ORM\Column(name="especialidad", type="string", length=255)
     */
    private $especialidad;

     /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaEnviado", type="datetime")
     */
    private $fechaEnviado;

    /**
    * @var \DateTime
    *
    * @ORM\Column(name="fechaRecomendacion", type="datetime")
    */
   private $fechaRecomendacion;

   /**
    * @var string
    * @ORM\Column(name="comentarios", type="string", length=255)
    */
   private $comentarios;

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
    public function setIdUsuarioEmpresa(User $id_UsuarioEmpresas)
    {
        $this->id_UsuarioEmpresas = $id_UsuarioEmpresas;
        return $this;
    }
    /**
     * Get id_candidato
     *
     * @return int
     */
    public function getIdUsuarioEmpresa()
    {
        return $this->id_UsuarioEmpresas;
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
     * Get the value of Visualizarse
     *
     * @return boolean
     */
    public function getVisualizarse()
    {
        return $this->visualizarse;
    }

    /**
     * Set the value of Visualizarse
     *
     * @param boolean visualizarse
     *
     * @return self
     */
    public function setVisualizarse($visualizarse)
    {
        $this->visualizarse = $visualizarse;

        return $this;
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
     * Get the value of Fecha Enviado
     *
     * @return \DateTime
     */
    public function getFechaEnviado()
    {
        return $this->fechaEnviado;
    }

    /**
     * Set the value of Fecha Enviado
     *
     * @param \DateTime fechaEnviado
     *
     * @return self
     */
    public function setFechaEnviado(\DateTime $fechaEnviado)
    {
        $this->fechaEnviado = $fechaEnviado;

        return $this;
    }

    /**
     * Get the value of Fecha Recomendacion
     *
     * @return \DateTime
     */
    public function getFechaRecomendacion()
    {
        return $this->fechaRecomendacion;
    }

    /**
     * Set the value of Fecha Recomendacion
     *
     * @param \DateTime fechaRecomendacion
     *
     * @return self
     */
    public function setFechaRecomendacion(\DateTime $fechaRecomendacion)
    {
        $this->fechaRecomendacion = $fechaRecomendacion;

        return $this;
    }

    /**
     * Get the value of Comentarios
     *
     * @return string
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }

    /**
     * Set the value of Comentarios
     *
     * @param string comentarios
     *
     * @return self
     */
    public function setComentarios($comentarios)
    {
        $this->comentarios = $comentarios;

        return $this;
    }

}
