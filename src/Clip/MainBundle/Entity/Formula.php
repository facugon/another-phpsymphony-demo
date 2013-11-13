<?php

namespace Clip\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formula
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Formula
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateStart", type="date")
     */
    private $dateStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEnd", type="date")
     */
    private $dateEnd;

    /**
     * @var integer
     *
     * @ORM\Column(name="ageMin", type="integer")
     */
    private $ageMin;

    /**
     * @var integer
     *
     * @ORM\Column(name="ageMax", type="integer")
     */
    private $ageMax;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Formula
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set dateStart
     *
     * @param \DateTime $dateStart
     * @return Formula
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;
    
        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime 
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     * @return Formula
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;
    
        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime 
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set ageMin
     *
     * @param integer $ageMin
     * @return Formula
     */
    public function setAgeMin($ageMin)
    {
        $this->ageMin = $ageMin;
    
        return $this;
    }

    /**
     * Get ageMin
     *
     * @return integer 
     */
    public function getAgeMin()
    {
        return $this->ageMin;
    }

    /**
     * Set ageMax
     *
     * @param integer $ageMax
     * @return Formula
     */
    public function setAgeMax($ageMax)
    {
        $this->ageMax = $ageMax;
    
        return $this;
    }

    /**
     * Get ageMax
     *
     * @return integer 
     */
    public function getAgeMax()
    {
        return $this->ageMax;
    }
}
