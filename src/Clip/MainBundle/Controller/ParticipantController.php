<?php

namespace Clip\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Clip\MainBundle\Entity\Participant;
use Clip\MainBundle\Form\ParticipantType;

/**
 * Participant controller.
 *
 * @Route("/participant")
 */
class ParticipantController extends Controller
{
    /**
     * Allow a Participant to subscribe to available formula
     *
     * @Route("/subscribe", name="participant_subscribe")
     * @Method("GET")
     * @Template()
     */
    public function subscribeAction()
    {
        $entity = new Participant();
        $form   = $this->createSubscribeForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Participant entity.
    *
    * @param Participant $entity The entity
    * @param string $action The submit form action 
    * @param string $entity The submit button label 
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createSubscribeForm(Participant $entity)
    {
        $form = $this->createForm(new ParticipantType(), $entity, array(
            'action' => $this->generateUrl('participant_createsubscription'),
            'method' => 'POST',
        ));

        $form->add('submit','submit',array('label' => 'Subscribe'));

        return $form;
    }

    /**
     * Creates a new Participant entity for Subscription.
     *
     * @Route("/createsubscription", name="participant_createsubscription")
     * @Method("POST")
     * @Template("ClipMainBundle:Participant:subscribe.html.twig")
     */
    public function createSubscriptionAction(Request $request)
    {
        $entity = new Participant();
        $form = $this->createSubscribeForm($entity,'participant_createsubscription','Subscribe');
        $form->handleRequest($request);

        if( $form->isValid() )
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('formula_subscribe', array('Participant_id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }
}
