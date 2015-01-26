<?php

namespace Setting\Bundle\LocationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Setting\Bundle\LocationBundle\Entity\Thana;
use Setting\Bundle\LocationBundle\Form\ThanaType;

/**
 * Thana controller.
 *
 */
class ThanaController extends Controller
{

    /**
     * Lists all Thana entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $keyword = $request -> query->get('search');

        $entities = $em->getRepository('SettingLocationBundle:Thana')->findBy(array(),array('name'=>'asc'));

        $pagination = $this->paginate($entities);

        return $this->render('SettingLocationBundle:Thana:index.html.twig', array(
            'pagination' => $pagination
        ));

    }

    public function deleteListAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SettingLocationBundle:Thana')->findBy(array(),array('name'=>'asc'));

        $pagination = $this->paginate($entities);

        return $this->render('SettingLocationBundle:Thana:delete.html.twig', array(
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
     * Creates a new Thana entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Thana();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "Data has been inserted successfully"
            );
            return $this->redirect($this->generateUrl('thana_show', array('id' => $entity->getId())));
        }

        return $this->render('SettingLocationBundle:Thana:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Thana entity.
     *
     * @param Thana $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Thana $entity)
    {

        $form = $this->createForm(new ThanaType(), $entity, array(
            'action' => $this->generateUrl('thana_create', array('id' => $entity->getId())),
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
     * Displays a form to create a new Thana entity.
     *
     */
    public function newAction()
    {
        $entity = new Thana();
        $form   = $this->createCreateForm($entity);

        return $this->render('SettingLocationBundle:Thana:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Thana entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SettingLocationBundle:Thana')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Thana entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SettingLocationBundle:Thana:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Thana entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SettingLocationBundle:Thana')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Thana entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SettingLocationBundle:Thana:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Thana entity.
    *
    * @param Thana $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Thana $entity)
    {

        $form = $this->createForm(new ThanaType(), $entity, array(
            'action' => $this->generateUrl('thana_update', array('id' => $entity->getId())),
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
     * Edits an existing Thana entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SettingLocationBundle:Thana')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Thana entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "Data has been updated successfully"
            );
            return $this->redirect($this->generateUrl('thana_edit', array('id' => $id)));
        }

        return $this->render('SettingLocationBundle:Thana:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Thana entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SettingLocationBundle:Thana')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Thana entity.');
            }

            try {

                $em->remove($entity);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'error',
                    "Data has been deleted successfully"
                );
            }catch(\Exception $e){
                $this->get('session')->getFlashBag()->add(
                    'warning',
                    "This table has a relation another table"
                );
            }

        }

        return $this->redirect($this->generateUrl('thana'));
    }

    /**
     * Creates a form to delete a Thana entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('thana_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }


    /**
     * Status a Thana entity.
     *
     */
    public function statusAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        //$data = $request->request->all();


        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('SettingLocationBundle:Thana')->find($id);

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
        return $this->redirect($this->generateUrl('thana'));
    }

}
