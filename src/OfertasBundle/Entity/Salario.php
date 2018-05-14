<?php

namespace OfertasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Salario
 *
 * @ORM\Table(name="salario")
 * @ORM\Entity(repositoryClass="OfertasBundle\Repository\SalarioRepository")
 */
class Salario
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
     * @ORM\Column(name="Salario", type="string", length=10)
     */
    private $salario;


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
     * Set salario
     *
     * @param string $salario
     *
     * @return Salario
     */
    public function setSalario($salario)
    {
        $this->salario = $salario;

        return $this;
    }

    /**
     * Get salario
     *
     * @return string
     */
    public function getSalario()
    {
        return $this->salario;
    }
    
    function __toString()
    {
        return $this->salario;
    }
}

