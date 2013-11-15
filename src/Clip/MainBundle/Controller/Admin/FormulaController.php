<?php

namespace Clip\MainBundle\Controller\Admin;

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

    /**
     * Lists all Formula entities.
     *
     * @Route("/", name="formula")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ClipMainBundle:Formula')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Formula entity.
     *
     * @Route("/", name="formula_create")
     * @Method("POST")
     * @Template("ClipMainBundle:Formula:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Formula();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('formula_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Formula entity.
    *
    * @param Formula $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Formula $entity)
    {
        $form = $this->createForm(new FormulaType(), $entity, array(
            'action' => $this->generateUrl('formula_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Formula entity.
     *
     * @Route("/new", name="formula_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Formula();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Formula entity.
     *
     * @Route("/{id}", name="formula_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClipMainBundle:Formula')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Formula entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Formula entity.
     *
     * @Route("/{id}/edit", name="formula_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClipMainBundle:Formula')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Formula entity.');
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
    * Creates a form to edit a Formula entity.
    *
    * @param Formula $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Formula $entity)
    {
        $form = $this->createForm(new FormulaType(), $entity, array(
            'action' => $this->generateUrl('formula_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Formula entity.
     *
     * @Route("/{id}", name="formula_update")
     * @Method("PUT")
     * @Template("ClipMainBundle:Formula:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClipMainBundle:Formula')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Formula entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('formula_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Formula entity.
     *
     * @Route("/{id}", name="formula_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ClipMainBundle:Formula')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Formula entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('formula'));
    }

    /**
     * Creates a form to delete a Formula entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('formula_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
