<?php

namespace Clip\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

use Clip\MainBundle\Entity\SubscriptionState as State;

use Clip\MainBundle\Entity\Formula;
use Clip\MainBundle\Entity\Participant;

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
     * @var Clip\MainBundle\Entity\Participant
     *
     * @ORM\ManyToOne(targetEntity="Clip\MainBundle\Entity\Participant")
     * @ORM\JoinColumn(name="participant_id", referencedColumnName="id")
     */
    private $participant;

    /**
     * @var Clip\MainBundle\Entity\Formula
     *
     * @ORM\ManyToOne(targetEntity="Clip\MainBundle\Entity\Formula")
     * @ORM\JoinColumn(name="formula_id", referencedColumnName="id")
     */
    private $formula;

    /**
     * @var Clip\MainBundle\Entity\SubscriptionState
     *
     * @ORM\ManyToOne(targetEntity="Clip\MainBundle\Entity\SubscriptionState")
     * @ORM\JoinColumn(name="subscriptionstate_id", referencedColumnName="id")
     */
    private $state ;

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
     * Set Participant
     *
     * @param integer $idParticipant
     * @return Subscription
     */
    public function setParticipant($participant)
    {
        $this->participant = $participant;
    
        return $this;
    }

    /**
     * Get Participant
     *
     * @return integer 
     */
    public function getParticipant()
    {
        return $this->participant;
    }

    /**
     * Set idFormula
     *
     * @param integer $idFormula
     * @return Subscription
     */
    public function setFormula($formula)
    {
        $this->formula = $formula;
    
        return $this;
    }

    /**
     * Get idFormula
     *
     * @return integer 
     */
    public function getFormula()
    {
        return $this->formula;
    }

    /**
     * Set idState
     *
     * @param integer id
     * @return Subscription
     */
    public function setState($state)
    {
        $this->state = $state;
    
        return $this;
    }

    /**
     * Get idState
     *
     * @return integer 
     */
    public function getState()
    {
        return $this->state;
    }
}
