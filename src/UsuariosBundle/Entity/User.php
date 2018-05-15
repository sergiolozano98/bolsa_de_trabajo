<?php

namespace UsuariosBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @UniqueEntity(fields="email", message="Email ya está registrado")
 * @UniqueEntity(fields="username", message="Nombre de usuario ya existe")
 */


/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UsuariosBundle\Repository\UserRepository")
 */
class User implements UserInterface
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
     * @Assert\NotBlank()
     * @Assert\Email()
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="Password", type="string", length=64)
     */
    private $password;

    /**
     */
     private $plainPassword;
    /**
     * @Assert\NotBlank()
     *
     * @Assert\Length(max=4096)
     */
    /*
    // private $plainPassword;
*/
    /**
    *
    * @ORM\Column(type="json_array")
    */
    private  $roles  =  array ();

    /**
     * @ORM\ManyToOne(targetEntity="EmpresasBundle\Entity\Empresa", inversedBy="nombre")
     * @ORM\JoinColumn(name="empresa", referencedColumnName="id")
     */
    private $empresa;

     /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="Nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="NIF", type="string", length=10)
     */
    private $nif;

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
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

     /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return User
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
     * Set nif
     *
     * @param string $nif
     *
     * @return string
     */
    public function setNif($nif)
    {
        $this->nif = $nif;

        return $this;
    }

    /**
     * Get nif
     *
     * @return string
     */
    public function getNif()
    {
        return $this->nif;
    }


     /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */

    public function getPassword()
    {
        return $this->password;
    }
    public function getPlainPassword()
{
   return $this->plainPassword;
}

public function setPlainPassword($password)
{
   $this->plainPassword = $password;
}



    /**
     * Set empresa
     *
     * @param string $empresa
     *
     * @return empresa
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get EMPRESA
     *
     * @return int
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }




    public function getSalt()
    {
        // The bcrypt and argon2i algorithms don't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }

    public function eraseCredentials() {

    }

    public function getRoles()
    {
      return $this->roles;
     }
    public function setRoles(array $roles)
{
    $this->roles = $roles;
}

}
