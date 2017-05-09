<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * AssembleGenerale
 *
 * @ORM\Table(name="assemble_generale")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\AssembleGeneraleRepository")
 */
class AssembleGenerale
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="piecejoint", type="string", length=255)
     */
    private $piecejoint;


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
     * Set titre
     *
     * @param string $titre
     *
     * @return AssembleGenerale
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

	 /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Article
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
    /**
     * Set piecejoint
     *
     * @param string $piecejoint
     *
     * @return AssembleGenerale
     */
    public function setPiecejoint($piecejoint)
    {
        $this->piecejoint = $piecejoint;

        return $this;
    }

    /**
     * Get piecejoint
     *
     * @return string
     */
    public function getPiecejoint()
    {
        return $this->piecejoint;
    }

   
}
