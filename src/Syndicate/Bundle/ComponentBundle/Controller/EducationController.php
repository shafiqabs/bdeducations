<?php

namespace Syndicate\Bundle\ComponentBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Syndicate\Bundle\ComponentBundle\Entity\Education;
use Syndicate\Bundle\ComponentBundle\Form\EducationType;


/**
 * Education controller.
 *
 */
class EducationController extends Controller
{

    /**
     * Lists all Education entities.
     *
     */

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $keyword = $request -> query->get('search');

        $entities = $em->getRepository('SyndicateComponentBundle:Education')->findBy(array(),array('name'=>'asc'));

        $pagination = $this->paginate($entities);

        return $this->render('SyndicateComponentBundle:Education:index.html.twig', array(
            'pagination' => $pagination
        ));

    }

    public function deleteListAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SyndicateComponentBundle:Education')->findBy(array(),array('name'=>'asc'));

        $pagination = $this->paginate($entities);

        return $this->render('SyndicateComponentBundle:Education:delete.html.twig', array(
            'pagination' => $pagination
        ));

    }



    public function paginate($entities)
    {

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $entities,
            $this->get('request')->query->get('page', 1)/*page number*/,
            30  /*limit per page*/
        );
        return $pagination;
    }



    /**
     * Creates a new Education entity.
     *
     */
    public function createAction(Request $request)
    {

        $user = $this->get('security.context')->getToken()->getUser();

        $entity = new Education();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $entity->upload();
            $entity->setUser($user);

            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',"Data has been inserted successfully"
            );
            return $this->redirect($this->generateUrl('education_show', array('id' => $entity->getId())));
        }

        return $this->render('SyndicateComponentBundle:Education:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Education entity.
     *
     * @param Education $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Education $entity)
    {

        $user = $this->get('security.context')->getToken()->getUser();
        $form = $this->createForm(new EducationType($user->getId()), $entity, array(
            'action' => $this->generateUrl('education_create', array('id' => $entity->getId())),
            'method' => 'POST',
            'attr' => array(
                'class' => 'form-horizontal',
                'novalidate' => 'novalidate',
            )
        ));

        $form->add('submit', 'submit', array('label' => 'Submit', 'attr' => array('class' => 'btn btn-primary')));
        $form->add('reset', 'reset', array('label' => 'Reset', 'attr' => array('class' => 'btn btn-danger')));

        return $form;
    }

    /**
     * Displays a form to create a new Education entity.
     *
     */
    public function newAction()
    {
        $entity = new Education();
        $form   = $this->createCreateForm($entity);

        return $this->render('SyndicateComponentBundle:Education:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Education entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SyndicateComponentBundle:Education')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Education entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SyndicateComponentBundle:Education:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Education entity.
     *
     */
    public function editAction($id)
    {

        //echo $this->getDoctrine()->getRepository('SyndicateComponentBundle:Education')->getGeoCode();
        //exit;
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SyndicateComponentBundle:Education')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Education entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SyndicateComponentBundle:Education:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Education entity.
     *
     * @param Education $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Education $entity)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $form = $this->createForm(new EducationType($user->getId()), $entity, array(
            'action' => $this->generateUrl('education_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array(
                'class' => 'form-horizontal',
                'novalidate' => 'novalidate',
            )
        ));

        $form->add('submit', 'submit', array('label' => 'Update', 'attr' => array('class' => 'btn btn-primary')));
        $form->add('reset', 'reset', array('label' => 'Reset', 'attr' => array('class' => 'btn btn-danger')));


        return $form;
    }
    /**
     * Edits an existing Education entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SyndicateComponentBundle:Education')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Education entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->upload();
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',"Data has been updated successfully"
            );

             return $this->redirect($this->generateUrl('education_edit', array('id' => $id)));
        }

        return $this->render('SyndicateComponentBundle:Education:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Education entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SyndicateComponentBundle:Education')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Education entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('education'));
    }

    /**
     * Creates a form to delete a Education entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('education_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
            ;
    }

    /**
     * Status a Page entity.
     *
     */
    public function statusAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        //$data = $request->request->all();


        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('SyndicateComponentBundle:Education')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find District entity.');
        }

        $status = $entity->getStatus();
        if($status == 1){
            $entity->setStatus(0);
        } else{
            $entity->setStatus(1);
        }
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'error',"Status has been changed successfully"
        );
        return $this->redirect($this->generateUrl('education'));
    }


}
