<?php

namespace AltCloud\Instance3AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AltCloud\Instance3Bundle\Entity\Node;
use Symfony\Component\HttpFoundation\Response;
use AltCloud\Instance3Bundle\Form\NodeType;

/**
 * Node controller.
 *
 */
class NodeAdminController extends Controller
{
    /**
     * Lists all Node entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('ACInst3Bundle:Node')->findAll();

        return $this->render('ACInst3AdminBundle:Node:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Node entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ACInst3Bundle:Node')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Node entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ACInst3AdminBundle:Node:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Node entity.
     *
     */
    public function newAction()
    {
        $entity = new Node();
        $form   = $this->createForm(new NodeType(), $entity);

        return $this->render('ACInst3AdminBundle:Node:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Node entity.
     *
     */
    public function createAction()
    {
        $entity  = new Node();
        $request = $this->getRequest();
        $form    = $this->createForm(new NodeType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_node_show', array('id' => $entity->getId())));
            
        }

        return $this->render('ACInst3AdminBundle:Node:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Node entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ACInst3Bundle:Node')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Node entity.');
        }

        $editForm = $this->createForm(new NodeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ACInst3AdminBundle:Node:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Node entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ACInst3Bundle:Node')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Node entity.');
        }

        $editForm   = $this->createForm(new NodeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_node_edit', array('id' => $id)));
        }

        return $this->render('ACInst3AdminBundle:Node:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Node entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('ACInst3Bundle:Node')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Node entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_node'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
