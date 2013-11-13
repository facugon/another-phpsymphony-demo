<?php

namespace Clip\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

use Clip\MainBundle\Entity\SubscriptionState as State;

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
     * @Assert\Type(type="numeric", message="The value {{ value }} is not a valid {{ type }}.")
     */
    private $idParticipant;

    /**
     * @var integer
     *
     * @ORM\Column(name="formula_id", type="integer")
     * @Assert\Type(type="numeric", message="The value {{ value }} is not a valid {{ type }}.")
     */
    private $idFormula;

    /**
     * @var integer
     *
     * @ORM\Column(name="subscriptionstate_id", type="integer")
     * @Assert\Type(type="numeric", message="The value {{ value }} is not a valid {{ type }}.")
     */
    private $idState = State::Informed ;


    /**
     * @var Clip\MainBundle\Entity\Participant
     *
     * @ORM\OneToOne(targetEntity="Clip\MainBundle\Entity\Participant")
     * @ORM\JoinColumn(name="participant_id", referencedColumnName="id")
     */
    private $participant;

    /**
     * @var Clip\MainBundle\Entity\Formula
     *
     * @ORM\OneToOne(targetEntity="Clip\MainBundle\Entity\Formula")
     * @ORM\JoinColumn(name="formula_id", referencedColumnName="id")
     */
    private $formula;

    /**
     * @var Clip\MainBundle\Entity\SubscriptionState
     *
     * @ORM\OneToOne(targetEntity="Clip\MainBundle\Entity\SubscriptionState")
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
     * Set idParticipant
     *
     * @param integer $idParticipant
     * @return Subscription
     */
    public function setParticipantId($idParticipant)
    {
        $this->idParticipant = $idParticipant;
    
        return $this;
    }

    /**
     * Get idParticipant
     *
     * @return integer 
     */
    public function getParticipantId()
    {
        return $this->idParticipant;
    }

    /**
     * Set idFormula
     *
     * @param integer $idFormula
     * @return Subscription
     */
    public function setFormulaId($idFormula)
    {
        $this->idFormula = $idFormula;
    
        return $this;
    }

    /**
     * Get idFormula
     *
     * @return integer 
     */
    public function getFormulaId()
    {
        return $this->idFormula;
    }

    /**
     * Set idState
     *
     * @param integer id
     * @return Subscription
     */
    public function setStateId($id)
    {
        $this->idState = $id;
    
        return $this;
    }

    /**
     * Get idState
     *
     * @return integer 
     */
    public function getStateId()
    {
        return $this->idState;
    }

    /**
     * Get status
     *
     * @return Clip\MainBundle\Entity\SubscriptionState
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Get participant
     *
     * @return Clip\MainBundle\Entity\Participant
     */
    public function getParticipant()
    {
        return $this->participant;
    }

    /**
     * Get formula
     *
     * @return Clip\MainBundle\Entity\Formula
     */
    public function getFormula()
    {
        return $this->formula;
    }
}
