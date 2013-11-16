<?php

namespace Clip\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Clip\MainBundle\Entity\Formula;
use Clip\MainBundle\Entity\Participant;
use Clip\MainBundle\Form\FormulaType;

/**
 * Formula controller.
 *
 * @Route("/formula")
 */
class FormulaController extends Controller
{
    /**
     * Lists all available Formulas for a Participant's Subscription
     *
     * @Route("/subscribe/{Participant_id}", name="formula_subscribe")
     * @Method("GET")
     * @Template()
     */
    public function subscribeAction($Participant_id)
    {
        $today = date('Y-m-d');
        $em = $this->getDoctrine()->getManager();

        $participant = $em->getRepository('ClipMainBundle:Participant')->find($Participant_id);

        $query = $em
            ->createQuery(
                'SELECT f FROM ClipMainBundle:Formula f
                WHERE f.ageMin <= :age AND f.ageMax >= :age'
            )
            ->setParameter('age',$participant->getAge());

        //$entities = $em->getRepository('ClipMainBundle:Formula')->findAll();
        $formulas = $query->getResult();

        return array( 'formulas' => $formulas, 'participant' => $participant );
    }
}
