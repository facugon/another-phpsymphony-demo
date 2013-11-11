<?php

namespace Clip\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subscription
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Subscription
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
     * @var integer
     *
     * @ORM\Column(name="participant_id", type="integer")
     */
    private $participantId;

    /**
     * @var integer
     *
     * @ORM\Column(name="formula_id", type="integer")
     */
    private $formulaId;


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
     * Set participantId
     *
     * @param integer $participantId
     * @return Subscription
     */
    public function setParticipantId($participantId)
    {
        $this->participantId = $participantId;
    
        return $this;
    }

    /**
     * Get participantId
     *
     * @return integer 
     */
    public function getParticipantId()
    {
        return $this->participantId;
    }

    /**
     * Set formulaId
     *
     * @param integer $formulaId
     * @return Subscription
     */
    public function setFormulaId($formulaId)
    {
        $this->formulaId = $formulaId;
    
        return $this;
    }

    /**
     * Get formulaId
     *
     * @return integer 
     */
    public function getFormulaId()
    {
        return $this->formulaId;
    }
}
