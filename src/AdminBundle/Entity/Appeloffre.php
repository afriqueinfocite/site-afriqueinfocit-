<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Appeloffre
 *
 * @ORM\Table(name="appeloffre")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\AppeloffreRepository")
 */
class Appeloffre
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
     * @ORM\Column(name="datedebut", type="datetime")
     */
    private $datedebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datefin", type="datetime")
     */
    private $datefin;

    /**
     * @var string
     *
     * @ORM\Column(name="fichierjoint", type="string", length=100)
	 * @Assert\NotBlank(message="Choisissez un fichier svp.")
	 * @Assert\File(maxSize = "10024k")
     */
    private $fichierjoint;


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
     * @return Appeloffre
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
     * Set datedebut
     *
     * @param \DateTime $datedebut
     *
     * @return Appeloffre
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    /**
     * Get datedebut
     *
     * @return \DateTime
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * Set datefin
     *
     * @param \DateTime $datefin
     *
     * @return Appeloffre
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin
     *
     * @return \DateTime
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * Set fichierjoint
     *
     * @param string $fichierjoint
     *
     * @return Appeloffre
     */
    public function setFichierjoint($fichierjoint)
    {
        $this->fichierjoint = $fichierjoint;

        return $this;
    }

    /**
     * Get fichierjoint
     *
     * @return string
     */
    public function getFichierjoint()
    {
        return $this->fichierjoint;
    }
}

