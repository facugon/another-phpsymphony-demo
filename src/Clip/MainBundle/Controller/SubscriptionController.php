<?php

namespace Clip\MainBundle\Controller;

#use Symfony\Component\HttpFoundation\Request;
#use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Clip\MainBundle\Entity\SubscriptionState as SubscriptionState;
use Clip\MainBundle\Form\SubscriptionType;

/**
 * Subscription controller.
 *
 * @Route("/subscription")
 */
class SubscriptionController extends Controller
{
    /**
     * Lists all Subscription entities.
     *
     * @Route("/", name="subscription")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
    }

    /**
     * Creates a new Subscription entity.
     *
     * @Route("/subscribe/{idParticipant}/{idFormula}", name="subscription_subscribe")
     * @Method("GET")
     * @Template("ClipMainBundle:Subscription:subscribe.html.twig")
     */
    public function subscribeAction($idParticipant,$idFormula)
    {
        $subscription = new Subscription();
        $subscription->setParticipantId($idParticipant);
        $subscription->setFormulaId($idFormula);

        $validator = $this->get('validator');
        $errors = $validator->validate($subscription);

        $error = false;
        if( count($errors) == 0 )
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($subscription);
            $em->flush();

            $id = $subscription->getId();
        }
        else $error = true ;

        return array('error' => $error, 'errors' => $errors);
    }
}
