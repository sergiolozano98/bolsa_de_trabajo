<?php
namespace OfertasBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use UsuariosBundle\Entity\Usuario;
use EmpresasBundle\Entity\Empresa;
/**
 * Oferta
 *
 * @ORM\Table(name="oferta")
 * @ORM\Entity(repositoryClass="OfertasBundle\Repository\OfertaRepository")
 */
class Oferta
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
     * @ORM\Column(name="Titulo", type="string", length=255)
     */
    private $titulo;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Fecha", type="datetime")
     */
    private $fecha;
    /**
     * @var int
     *
     * @ORM\Column(name="Usuario", type="integer")
     */
    private $usuario;
    /**
     * @ORM\ManytoOne(targetEntity="EmpresasBundle\Entity\Empresa", inversedBy="oferta")
     * @ORM\JoinColumn(name="Empresa", referencedColumnName="id")
     */
    private $empresa;
    /**
    * @ORM\OneToMany(targetEntity="Estudios", mappedBy="oferta")
    */
    private $estudios;
    /**
     * @ORM\ManytoOne(targetEntity="Estado", inversedBy="oferta")
     * @ORM\JoinColumn(name="estado", referencedColumnName="id")
     */
    private $estado;
    /**
     * @var string
     *
     * @ORM\Column(name="Descripcion", type="string", length=255)
     */
    private $descripcion;
    /**
     * @var string
     *
     * @ORM\Column(name="DescripcionAlternativa", type="string", length=255, nullable=true)
     */
    private $descripcionAlternativa;
    /**
     * @var int
     *
     * @ORM\Column(name="Puestos", type="integer")
     */
    private $puestos;
    /**
     * @ORM\ManyToMany(targetEntity="Categoria", inversedBy="ofertas")
     * @ORM\JoinColumn(name="categorias", referencedColumnName="id")
     */
    private $categorias;
    /**
     * @var string
     *
     * @ORM\Column(name="SubCategoria", type="string", length=255)
     */
    private $subCategoria;
    /**
     * @var string
     *
     * @ORM\Column(name="LugarCentroTrabajo", type="string", length=255)
     */
    private $lugarCentroTrabajo;
    /**
     * @var string
     *
     * @ORM\Column(name="Localidad", type="string", length=255)
     */
    private $localidad;
    /**
     * @ORM\ManytoOne(targetEntity="ProvinciasOferta", inversedBy="oferta")
     * @ORM\JoinColumn(name="provincia", referencedColumnName="id")
     */
    private $provincia;
    /**
     * @var string
     *
     * @ORM\Column(name="Pais", type="string", length=255)
     */
    private $pais;
    /**
     * @var bool
     *
     * @ORM\Column(name="ExperienciaSector", type="boolean")
     */
    private $experienciaSector;
    /**
     * @var string
     *
     * @ORM\Column(name="ExperienciaMinima", type="string", length=20)
     */
    private $experienciaMinima;
    /**
     * @var bool
     *
     * @ORM\Column(name="Minusvalia", type="boolean")
     */
    private $minusvalia;
    /**
     * @var bool
     *
     * @ORM\Column(name="Beca", type="boolean")
     */
    private $beca;
    /**
     * @ORM\ManytoOne(targetEntity="Salario", inversedBy="oferta")
     * @ORM\JoinColumn(name="salario", referencedColumnName="id")
     */
    private $salario;
    /**
     * @ORM\ManytoOne(targetEntity="Contrato", inversedBy="oferta")
     * @ORM\JoinColumn(name="tipoContrato", referencedColumnName="id")
     */
    private $tipoContrato;
    /**
     * @ORM\ManytoOne(targetEntity="JornadaLaboral", inversedBy="oferta")
     * @ORM\JoinColumn(name="jornadaLaboral", referencedColumnName="id")
     */
    private $jornadaLaboral;
     /**
     * @var string
     *
     * @ORM\Column(name="Beneficios", type="string", length=20)
     */
    private $beneficios;
    /**
     * @ORM\ManyToMany(targetEntity="Idioma", inversedBy="ofertas")
     * @ORM\JoinColumn(name="idiomas", referencedColumnName="id")
     */
    private $idiomas;

    /**
     * @ORM\OneToMany(targetEntity="UsuariosBundle\Entity\Candidato", mappedBy="ofertas")
     */
    private $oferta;
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
     * Set titulo
     *
     * @param string $titulo
     *
     * @return Oferta
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
        return $this;
    }
    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }
    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Oferta
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
        return $this;
    }
    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }
    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return Oferta
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
        return $this;
    }
    /**
     * Get usuario
     *
     * @return int
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
    /**
     * Set empresa
     *
     * @param integer $usuario
     *
     * @return Oferta
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
        return $this;
    }
    /**
     * Get empresa
     *
     * @return int
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }
    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return Oferta
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
        return $this;
    }
    /**
     * Get estado
     *
     * @return int
     */
    public function getEstado()
    {
        return $this->estado;
    }
    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Oferta
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
     * Set descripcionAlternativa
     *
     * @param string $descripcionAlternativa
     *
     * @return Oferta
     */
    public function setDescripcionAlternativa($descripcionAlternativa)
    {
        $this->descripcionAlternativa = $descripcionAlternativa;
        return $this;
    }
    /**
     * Get descripcionAlternativa
     *
     * @return string
     */
    public function getDescripcionAlternativa()
    {
        return $this->descripcionAlternativa;
    }
    /**
     * Set puestos
     *
     * @param integer $puestos
     *
     * @return Oferta
     */
    public function setPuestos($puestos)
    {
        $this->puestos = $puestos;
        return $this;
    }
    /**
     * Get puestos
     *
     * @return int
     */
    public function getPuestos()
    {
        return $this->puestos;
    }
    /**
     * Set subCategoria
     *
     * @param string $subCategoria
     *
     * @return Oferta
     */
    public function setSubCategoria($subCategoria)
    {
        $this->subCategoria = $subCategoria;
        return $this;
    }
    /**
     * Get subCategoria
     *
     * @return string
     */
    public function getSubCategoria()
    {
        return $this->subCategoria;
    }
    /**
     * Set lugarCentroTrabajo
     *
     * @param string $lugarCentroTrabajo
     *
     * @return Oferta
     */
    public function setLugarCentroTrabajo($lugarCentroTrabajo)
    {
        $this->lugarCentroTrabajo = $lugarCentroTrabajo;
        return $this;
    }
    /**
     * Get lugarCentroTrabajo
     *
     * @return string
     */
    public function getLugarCentroTrabajo()
    {
        return $this->lugarCentroTrabajo;
    }
    /**
     * Set pais
     *
     * @param string $pais
     *
     * @return Oferta
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
     * Set localidad
     *
     * @param string $localidad
     *
     * @return Oferta
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
     * Set experienciaSector
     *
     * @param boolean $experienciaSector
     *
     * @return Oferta
     */
    public function setExperienciaSector($experienciaSector)
    {
        $this->experienciaSector = $experienciaSector;
        return $this;
    }
    /**
     * Get experienciaSector
     *
     * @return bool
     */
    public function getExperienciaSector()
    {
        return $this->experienciaSector;
    }
    /**
     * Set experienciaMinima
     *
     * @param string $experienciaMinima
     *
     * @return Oferta
     */
    public function setExperienciaMinima($experienciaMinima)
    {
        $this->experienciaMinima = $experienciaMinima;
        return $this;
    }
    /**
     * Get experienciaMinima
     *
     * @return string
     */
    public function getExperienciaMinima()
    {
        return $this->experienciaMinima;
    }
    /**
     * Set minusvalia
     *
     * @param boolean $minusvalia
     *
     * @return Oferta
     */
    public function setMinusvalia($minusvalia)
    {
        $this->minusvalia = $minusvalia;
        return $this;
    }
    /**
     * Get minusvalia
     *
     * @return bool
     */
    public function getMinusvalia()
    {
        return $this->minusvalia;
    }
    /**
     * Set beca
     *
     * @param boolean $beca
     *
     * @return Oferta
     */
    public function setBeca($beca)
    {
        $this->beca = $beca;
        return $this;
    }
    /**
     * Get beca
     *
     * @return bool
     */
    public function getBeca()
    {
        return $this->beca;
    }
    /**
     * Set salario
     *
     * @param integer $salario
     *
     * @return Oferta
     */
    public function setSalario($salario)
    {
        $this->salario = $salario;
        return $this;
    }
    /**
     * Get salario
     *
     * @return int
     */
    public function getSalario()
    {
        return $this->salario;
    }
    /**
     * Set idioma
     *
     * @param integer $idioma
     *
     * @return Idioma
     */
    public function setEstudios($estudios)
    {
        $this->estudios = $estudios;
        return $this;
    }
    /**
     * Get estudios
     *
     * @return int
     */
    public function getEstudios()
    {
        return $this->estudios;
    }
    /**
     * Set tipoContrato
     *
     * @param integer $tipoContrato
     *
     * @return Oferta
     */
    public function setTipoContrato($tipoContrato)
    {
        $this->tipoContrato = $tipoContrato;
        return $this;
    }
    /**
     * Get tipoContrato
     *
     * @return int
     */
    public function getTipoContrato()
    {
        return $this->tipoContrato;
    }
    /**
     * Set jornadaLaboral
     *
     * @param integer $jornadaLaboral
     *
     * @return Oferta
     */
    public function setJornadaLaboral($jornadaLaboral)
    {
        $this->jornadaLaboral = $jornadaLaboral;
        return $this;
    }
    /**
     * Get jornadaLaboral
     *
     * @return int
     */
    public function getJornadaLaboral()
    {
        return $this->jornadaLaboral;
    }
     /**
     * Set beneficios
     *
     * @param string $beneficios
     *
     * @return Oferta
     */
    public function setBeneficios($beneficios)
    {
        $this->beneficios = $beneficios;
        return $this;
    }
    /**
     * Get beneficios
     *
     * @return string
     */
    public function getBeneficios()
    {
        return $this->beneficios;
    }
    /**
     * Set provincia
     *
     * @param \OfertasBundle\Entity\ProvinciaOferta $provincia
     *
     * @return Oferta
     */
    public function setProvincia(\OfertasBundle\Entity\ProvinciasOferta $provincia = null)
    {
        $this->provincia = $provincia;
        return $this;
    }
    /**
     * Get provincia
     *
     * @return \OfertaBundle\Entity\ProvinciasOferta
     */
    public function getProvincia()
    {
        return $this->provincia;
    }
    /**
     * Set categorias
     *
     * @param \OfertasBundle\Entity\Categoria $categorias
     *
     * @return Oferta
     */
    public function setCategorias(\OfertasBundle\Entity\Categoria $categorias = null)
    {
        $this->categorias = $categorias;
        return $this;
    }
    /**
     * Set idiomas
     *
     * @param \OfertasBundle\Entity\Categoria $idiomas
     *
     * @return Oferta
     */
    public function setIdiomas(\OfertasBundle\Entity\Idioma $idioma = null)
    {
        $this->idiomas = $idioma;
        return $this;
    }
    /**
     * Get categorias
     *
     * @return \OfertasBundle\Entity\Categoria
     */
    public function getCategorias()
    {
        return $this->categorias;
    }
    /**
     * Get idiomas
     *
     * @return \OfertasBundle\Entity\Idioma
     */
    public function getIdiomas()
    {
        return $this->idiomas;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categorias = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idiomas = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * Add categoria
     *
     * @param \OfertasBundle\Entity\Categoria $categoria
     *
     * @return Oferta
     */
    public function addCategoria(\OfertasBundle\Entity\Categoria $categoria)
    {
        $this->categorias[] = $categoria;
        return $this;
    }
    /**
     * Remove categoria
     *
     * @param \OfertasBundle\Entity\Categoria $categoria
     */
    public function removeCategoria(\OfertasBundle\Entity\Categoria $categoria)
    {
        $this->categorias->removeElement($categoria);
    }
    /**
     * Add $idiomas
     *
     * @param \OfertasBundle\Entity\Idioma $idioma
     *
     * @return Oferta
     */
    public function addIdiomas(\OfertasBundle\Entity\Idioma $idioma)
    {
        $this->idiomas[] = $idioma;
        return $this;
    }
    /**
     * Remove idioma
     *
     * @param \OfertasBundle\Entity\Idioma $idioma
     */
    public function removeIdiomas(\OfertasBundle\Entity\Idioma $idioma)
    {
        $this->idiomas->removeElement($idioma);
    }
    private function DameUsuario($usuario){
        $Usuarios = $this->getDoctrine()->getRepository('UsuariosBundle:user');
        $empresa = $Usuarios->find($usuario)->getEmpresa();
        die();
        $Empresas = $this->getDoctrine()->getRepository('EmpresasBundle:Empresa');
        $empresa = $Empresas->find($empresa)->getNombre();
        $empresaAlt = $Empresas->find($empresa)->getNombre();
        return $usuario;
    }
    /**
         * @param Conocimiento $conocimiento
         */
        public function addConocimiento(Conocimiento $conocimiento)
        {
            if ($this->conocimiento->contains($conocimiento)) {
                return;
            }
            $this->conocimiento->add($conocimiento);
            $conocimiento->addUser($this);
        }
        /**
         * @param Conocimiento $conocimiento
         */
        public function removeUserGroup(Conocimiento $conocimiento)
        {
            if (!$this->conocimiento->contains($conocimiento)) {
                return;
            }
            $this->conocimiento->removeElement($conocimiento);
            $conocimiento->removeUser($this);
        }



    public function DameOfertasEmpresa($empresa){
    // Devuelve todas las Ofertas de una empresa determinada
        $repository = $this->getdoctrine()->getRepository('OfertasBundle:Oferta');
        $consulta = $repository->createQueryBuilder('o')
                ->where('o.empresa  = :empresa ')
                ->setParameter('empresa', $empresa)
                ->orderBy('o.fecha', 'DESC')
             ->getQuery();
            $ofertas = $consulta->getResult();
    Return $ofertas;
    }

    public function DameOfertasUsuarioEmpresaPorEstado($empresa,$tipo){
        // Devielve sólo las ofertas de una empresa y según el estado indicado (tipo)
        $repository = $this->getdoctrine()->getRepository('OfertasBundle:Oferta');
        $consulta = $repository->createQueryBuilder('o')
                    ->where('o.empresa  = :empresa and o.estado  = :estado ')
                    ->setParameter('empresa', $empresa)
                    ->setParameter('estado', $tipo)
                    ->orderBy('o.fecha', 'DESC')
                 ->getQuery();
                $ofertas = $consulta->getResult();
        Return $ofertas;
    }

    function __toString()
    {
        return $this->provincia;
    }
}
