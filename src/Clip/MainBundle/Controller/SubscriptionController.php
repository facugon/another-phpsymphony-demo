<?php

namespace Clip\MainBundle\Controller;

#use Symfony\Component\HttpFoundation\Request;
#use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Clip\MainBundle\Entity\Subscription;
#use Clip\MainBundle\Entity\Formula;
#use Clip\MainBundle\Entity\Participant;

use Clip\MainBundle\Entity\SubscriptionState as SubscriptionState;
#use Clip\MainBundle\Form\SubscriptionType;

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
        $em = $this->getDoctrine()->getManager();
        $participant = $em->getRepository('ClipMainBundle:Participant')->find($idParticipant);
        $formula     = $em->getRepository('ClipMainBundle:Formula')->find($idFormula);
        $state       = $em->getRepository('ClipMainBundle:SubscriptionState')->find(SubscriptionState::Informed);

        $subscription = new Subscription();
        $subscription->setParticipant ($participant);
        $subscription->setFormula     ($formula);
        $subscription->setState       ($state);

        $validator = $this->get('validator');
        $errors = $validator->validate($subscription);

        $error = false;
        if( count($errors) == 0 )
        {
            $em->persist($subscription);
            $em->flush();

            $id = $subscription->getId();
        }
        else $error = true ;

        return array('error' => $error, 'errors' => $errors);
    }
}
