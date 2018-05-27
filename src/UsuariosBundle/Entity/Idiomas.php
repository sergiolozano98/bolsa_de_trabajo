<?php
namespace UsuariosBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Curriculum
 *
 * @ORM\Table(name="Idiomas")
 * @ORM\Entity(repositoryClass="UsuariosBundle\Repository\IdiomasRepository")
 */
class Idiomas
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
     * @ORM\ManyToOne(targetEntity="\OfertasBundle\Entity\Idioma", inversedBy="idiomas")
     * @ORM\JoinColumn(name="idioma", referencedColumnName="id")
     */
    private $idioma;
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
    public function setIdioma(\OfertasBundle\Entity\Idioma $idioma)
    {
        $this->idioma = $idioma;
        return $this;
    }
    /**
     * Get id_candidato
     *
     * @return int
     */
    public function getIdioma()
    {
        return $this->idioma;
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
