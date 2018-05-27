<?php
namespace UsuariosBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Curriculum
 *
 * @ORM\Table(name="Categorias")
 * @ORM\Entity(repositoryClass="UsuariosBundle\Repository\RecomendacionesRepository")
 */
class Categorias
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="categorias")
     * @ORM\JoinColumn(name="id_candidato", referencedColumnName="id")
     */
    private $id_Candidato;

    /**
     * @ORM\ManyToOne(targetEntity="\OfertasBundle\Entity\Categoria", inversedBy="categorias")
     * @ORM\JoinColumn(name="id_Categoria", referencedColumnName="id")
     */
    private $id_Categoria;


    /**
     * @var string
     * @ORM\Column(name="nivel_conocimiento", type="string", length=255)
     */
    private $nivelConocimiento;


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
    public function setId_Categoria(\OfertasBundle\Entity\Categoria $id_Categoria)
    {
        $this->id_Categoria = $id_Categoria;
        return $this;
    }
    /**
     * Get id_candidato
     *
     * @return int
     */
    public function getId_Categoria()
    {
        return $this->id_Categoria;
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
     * Get the value of Nivel Conocimiento
     *
     * @return string
     */
    public function getNivelConocimiento()
    {
        return $this->nivelConocimiento;
    }

    /**
     * Set the value of Nivel Conocimiento
     *
     * @param string nivelConocimiento
     *
     * @return self
     */
    public function setNivelConocimiento($nivelConocimiento)
    {
        $this->nivelConocimiento = $nivelConocimiento;

        return $this;
    }

}
