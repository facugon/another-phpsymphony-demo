<?php

namespace Clip\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Clip\MainBundle\Entity\Subscription;
use Clip\MainBundle\Entity\Formula;
use Clip\MainBundle\Entity\Participant;

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
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ClipMainBundle:Subscription')->findAll();

        return array(
            'entities' => $entities,
        );
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
        $formula = $em->getRepository('ClipMainBundle:Formula')->find($idFormula);
        $state = $em->getRepository('ClipMainBundle:SubscriptionState')->find(SubscriptionState::Informed);

        $subscription = new Subscription();
        $subscription->setParticipant($participant);
        $subscription->setFormula($formula);
        $subscription->setState($state);

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

    /**
     * Creates a new Subscription entity.
     *
     * @Route("/", name="subscription_create")
     * @Method("POST")
     * @Template("ClipMainBundle:Subscription:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Subscription();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('subscription_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Subscription entity.
    *
    * @param Subscription $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Subscription $entity)
    {
        $form = $this->createForm(new SubscriptionType(), $entity, array(
            'action' => $this->generateUrl('subscription_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Subscription entity.
     *
     * @Route("/new", name="subscription_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Subscription();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Subscription entity.
     *
     * @Route("/{id}", name="subscription_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClipMainBundle:Subscription')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Subscription entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Confirm the participant subscription
     *
     * @Route("/confirm/{id}", name="subscription_confirm")
     * @Method("GET")
     * @Template()
     */
    public function confirmAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $subscription = $em->getRepository('ClipMainBundle:Subscription')->find($id);

        if ( !$subscription ) throw $this->createNotFoundException('Unable to find Subscription entity.');

        $state = $em->getRepository('ClipMainBundle:SubscriptionState')->find( SubscriptionState::Confirmed );
        $subscription->setState( $state );

        $em->persist($subscription);
        $em->flush();

        return $this->redirect($this->generateUrl('subscription'));
    }

    /**
     * Displays a form to edit an existing Subscription entity.
     *
     * @Route("/{id}/edit", name="subscription_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClipMainBundle:Subscription')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Subscription entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Subscription entity.
    *
    * @param Subscription $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Subscription $entity)
    {
        $form = $this->createForm(new SubscriptionType(), $entity, array(
            'action' => $this->generateUrl('subscription_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Subscription entity.
     *
     * @Route("/{id}", name="subscription_update")
     * @Method("PUT")
     * @Template("ClipMainBundle:Subscription:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClipMainBundle:Subscription')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Subscription entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('subscription_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Subscription entity.
     *
     * @Route("/{id}", name="subscription_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ClipMainBundle:Subscription')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Subscription entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('subscription'));
    }

    /**
     * Creates a form to delete a Subscription entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('subscription_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
