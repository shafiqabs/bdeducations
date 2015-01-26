<?php

namespace Setting\Bundle\LocationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Setting\Bundle\LocationBundle\Entity\District;
use Setting\Bundle\LocationBundle\Form\DistrictType;

/**
 * District controller.
 *
 */
class DistrictController extends Controller
{

    /**
     * Lists all District entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();


        $keyword = $request->query->get('search');

        $entities = $em->getRepository('SettingLocationBundle:District')->findBy(array(),array('name'=>'asc'));

        $pagination = $this->paginate($entities);

        return $this->render('SettingLocationBundle:District:index.html.twig', array(
            'pagination' => $pagination
        ));
    }

    public function deleteListAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SettingLocationBundle:District')->findAll();

        $pagination = $this->paginate($entities);

        return $this->render('SettingLocationBundle:District:delete.html.twig', array(
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
     * Creates a new District entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new District();
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
            return $this->redirect($this->generateUrl('district_show', array('id' => $entity->getId())));
        }

        return $this->render('SettingLocationBundle:District:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a District entity.
     *
     * @param District $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(District $entity)
    {

        $form = $this->createForm(new DistrictType(), $entity, array(
            'action' => $this->generateUrl('district_create'),
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
     * Displays a form to create a new District entity.
     *
     */
    public function newAction()
    {
        $entity = new District();
        $form   = $this->createCreateForm($entity);

        return $this->render('SettingLocationBundle:District:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a District entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SettingLocationBundle:District')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find District entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SettingLocationBundle:District:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing District entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SettingLocationBundle:District')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find District entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SettingLocationBundle:District:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a District entity.
    *
    * @param District $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(District $entity)
    {
        $form = $this->createForm(new DistrictType(), $entity, array(
            'action' => $this->generateUrl('district_update', array('id' => $entity->getId())),
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
     * Edits an existing District entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SettingLocationBundle:District')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find District entity.');
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
            return $this->redirect($this->generateUrl('district_edit', array('id' => $id)));
        }

        return $this->render('SettingLocationBundle:District:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a District entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SettingLocationBundle:District')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find District entity.');
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

        return $this->redirect($this->generateUrl('district'));
    }

    /**
     * Creates a form to delete a District entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('district_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    /**
     * Status a Division entity.
     *
     */
    public function statusAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        //$data = $request->request->all();


        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('SettingLocationBundle:District')->find($id);

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
        return $this->redirect($this->generateUrl('district'));
    }

}
