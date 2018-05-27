<?php
namespace UsuariosBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Curriculum
 *
 * @ORM\Table(name="Curriculum")
 * @ORM\Entity(repositoryClass="UsuariosBundle\Repository\CurriculumRepository")
 */
class Curriculum
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="candidatos")
     * @ORM\JoinColumn(name="id_candidato", referencedColumnName="id")
     */
    private $id_Candidato;
    /**
     * @var string
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;
    /**
     * @var string
     * @ORM\Column(name="direccion", type="string", length=255)
     */
    private $direccion;

    /**
     * @ORM\ManyToOne(targetEntity="EmpresasBundle\Entity\Provincia", inversedBy="curriculums")
     * @ORM\JoinColumn(name="provincia", referencedColumnName="id")
     */
    private $provincia;
     /**
     * @var string
     * @ORM\Column(name="localidad", type="string", length=255)
     */
    private $localidad;
    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="telefono", type="string", length=10)
     */
    private $telefono;
     /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaNacimiento", type="datetime")
     */
    private $fechaNacimiento;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="DNI", type="string", length=20)
     */
    private $DNI;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="Carnet_Conducir", type="string", length=20)
     */
    private $carnet_conducir;


     /**
     * @var bool
     *
     * @ORM\Column(name="vehiculo_propio", type="boolean")
     */
    private $vehiculo_propio;

    /**
    * @var bool
    *
    * @ORM\Column(name="minusvalia", type="boolean")
    */
   private $minusvalia;

   /**
   * @var bool
   *
   * @ORM\Column(name="beca", type="boolean")
   */
  private $beca;

  /**
  * @var bool
  *
  * @ORM\Column(name="cambio_residencia", type="boolean")
  */
 private $cambio_residencia;

 /**
 * @var bool
 *
 * @ORM\Column(name="puede_viajar", type="boolean")
 */
private $puede_viajar;

/**
* @var integer
*
* @ORM\Column(name="salario", type="integer")
*/
private $salario;

/**
* @var string
*
* @ORM\Column(name="comentario", type="string")
*/
private $comentario;

/**
* @var string
*
* @ORM\Column(name="foto", type="string")
*/
private $foto;

/**
* @var string
*
* @ORM\Column(name="documento", type="string")
*/
private $documento;

/**
* @var \DateTime
*
* @ORM\Column(name="fecha_de_alta", type="datetime")
*/
private $fechaDeAlta;

/**
* @var \DateTime
*
* @ORM\Column(name="fecha_de_modificacion", type="datetime")
*/
private $fechaDeModificacion;

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
     * Set provincia
     *
     * @param integer provincia
     *
     * @return id_candidato
     */
    public function setProvincia(\EmpresasBundle\Entity\Provincia $provincia)
    {
        $this->provincia = $provincia;
        return $this;
    }
    /**
     * Get provincia
     *
     * @return int
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Get the value of Nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of Nombre
     *
     * @param string nombre
     *
     * @return self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of Direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of Direccion
     *
     * @param string direccion
     *
     * @return self
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }


    /**
     * Get the value of Localidad
     *
     * @return string
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * Set the value of Localidad
     *
     * @param string localidad
     *
     * @return self
     */
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;

        return $this;
    }

    /**
     * Get the value of Telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set the value of Telefono
     *
     * @param string telefono
     *
     * @return self
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get the value of Fecha Nacimiento
     *
     * @return \DateTime
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set the value of Fecha Nacimiento
     *
     * @param \DateTime fechaNacimiento
     *
     * @return self
     */
    public function setFechaNacimiento(\DateTime $fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get the value of DNI
     *
     * @return string
     */
    public function getDNI()
    {
        return $this->DNI;
    }

    /**
     * Set the value of DNI
     *
     * @param string DNI
     *
     * @return self
     */
    public function setDNI($DNI)
    {
        $this->DNI = $DNI;

        return $this;
    }

    /**
     * Get the value of Carnet Conducir
     *
     * @return string
     */
    public function getCarnetConducir()
    {
        return $this->carnet_conducir;
    }

    /**
     * Set the value of Carnet Conducir
     *
     * @param string carnet_conducir
     *
     * @return self
     */
    public function setCarnetConducir($carnet_conducir)
    {
        $this->carnet_conducir = $carnet_conducir;

        return $this;
    }

    /**
     * Get the value of Vehiculo Propio
     *
     * @return bool
     */
    public function getVehiculoPropio()
    {
        return $this->vehiculo_propio;
    }

    /**
     * Set the value of Vehiculo Propio
     *
     * @param bool vehiculo_propio
     *
     * @return self
     */
    public function setVehiculoPropio($vehiculo_propio)
    {
        $this->vehiculo_propio = $vehiculo_propio;

        return $this;
    }

    /**
     * Get the value of Minusvalia
     *
     * @return bool
     */
    public function getMinusvalia()
    {
        return $this->minusvalia;
    }

    /**
     * Set the value of Minusvalia
     *
     * @param bool minusvalia
     *
     * @return self
     */
    public function setMinusvalia($minusvalia)
    {
        $this->minusvalia = $minusvalia;

        return $this;
    }

    /**
     * Get the value of Beca
     *
     * @return bool
     */
    public function getBeca()
    {
        return $this->beca;
    }

    /**
     * Set the value of Beca
     *
     * @param bool beca
     *
     * @return self
     */
    public function setBeca($beca)
    {
        $this->beca = $beca;

        return $this;
    }

    /**
     * Get the value of Cambio Residencia
     *
     * @return bool
     */
    public function getCambioResidencia()
    {
        return $this->cambio_residencia;
    }

    /**
     * Set the value of Cambio Residencia
     *
     * @param bool cambio_residencia
     *
     * @return self
     */
    public function setCambioResidencia($cambio_residencia)
    {
        $this->cambio_residencia = $cambio_residencia;

        return $this;
    }

    /**
     * Get the value of Puede Viajar
     *
     * @return bool
     */
    public function getPuedeViajar()
    {
        return $this->puede_viajar;
    }

    /**
     * Set the value of Puede Viajar
     *
     * @param bool puede_viajar
     *
     * @return self
     */
    public function setPuedeViajar($puede_viajar)
    {
        $this->puede_viajar = $puede_viajar;

        return $this;
    }

    /**
     * Get the value of Integer
     *
     * @return integer
     */
    public function getInteger()
    {
        return $this->integer;
    }

    /**
     * Set the value of Integer
     *
     * @param integer integer
     *
     * @return self
     */
    public function setInteger($integer)
    {
        $this->integer = $integer;

        return $this;
    }

    /**
     * Get the value of Comentario
     *
     * @return string
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set the value of Comentario
     *
     * @param string comentario
     *
     * @return self
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get the value of Foto
     *
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set the value of Foto
     *
     * @param string foto
     *
     * @return self
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get the value of Documento
     *
     * @return string
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Set the value of Documento
     *
     * @param string documento
     *
     * @return self
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * Get the value of Fecha De Alta
     *
     * @return \DateTime
     */
    public function getFechaDeAlta()
    {
        return $this->fechaDeAlta;
    }

    /**
     * Set the value of Fecha De Alta
     *
     * @param \DateTime fechaDeAlta
     *
     * @return self
     */
    public function setFechaDeAlta(\DateTime $fechaDeAlta)
    {
        $this->fechaDeAlta = $fechaDeAlta;

        return $this;
    }

    /**
     * Get the value of Fecha De Modificacion
     *
     * @return \DateTime
     */
    public function getFechaDeModificacion()
    {
        return $this->fechaDeModificacion;
    }

    /**
     * Set the value of Fecha De Modificacion
     *
     * @param \DateTime fechaDeModificacion
     *
     * @return self
     */
    public function setFechaDeModificacion(\DateTime $fechaDeModificacion)
    {
        $this->fechaDeModificacion = $fechaDeModificacion;

        return $this;
    }

}
