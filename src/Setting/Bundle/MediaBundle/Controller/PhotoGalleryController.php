<?php

namespace Setting\Bundle\MediaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Setting\Bundle\MediaBundle\Entity\PhotoGallery;
use Setting\Bundle\MediaBundle\Form\PhotoGalleryType;

/**
 * PhotoGallery controller.
 *
 */
class PhotoGalleryController extends Controller
{

    /**
     * Lists all PhotoGallery entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $entities = $em->getRepository('SettingMediaBundle:PhotoGallery')->findBy(array('user'=>$user),array('created'=>'desc'));

        $pagination = $this->paginate($entities);

        return $this->render('SettingMediaBundle:PhotoGallery:index.html.twig', array(
            'pagination' => $pagination
        ));

    }


    public function galleriesDeleteList()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SettingMediaBundle:PhotoGallery')->findAll();

        $pagination = $this->paginate($entities);

        return $this->render('SettingMediaBundle:PhotoGallery:index.html.twig', array(
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
     * Lists all PhotoGallery entities.
     *
     */
    public function galleryAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.context')->getToken()->getUser();
        $userId = $user->getId();

        $entities = $em->getRepository('SettingMediaBundle:PhotoGallery')->findBy(array('user' => $userId ),array('created'=>'desc'));

        return $this->render('SettingMediaBundle:PhotoGallery:index.html.twig', array(
            'pagination' => $entities,
        ));
    }

    /**
     * Lists all PhotoGallery entities.
     *
     */
    public function galleryDeleteAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.context')->getToken()->getUser();
        $userId = $user->getId();

        $entities = $em->getRepository('SettingMediaBundle:PhotoGallery')->findBy(array('user' => $userId ),array('created'=>'desc'));

        return $this->render('SettingMediaBundle:PhotoGallery:index.html.twig', array(
            'pagination' => $entities,
        ));
    }


    /**
     * Creates a new PhotoGallery entity.
     *
     */
    public function createAction(Request $request)
    {

        $entity = new PhotoGallery();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $user = $this->get('security.context')->getToken()->getUser();

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $entity->setUser($user);
            $entity->upload();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',"Data has been inserted successfully"
            );
            return $this->redirect($this->generateUrl('gallery_show', array('id' => $entity->getId())));
        }

        return $this->render('SettingMediaBundle:PhotoGallery:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a PhotoGallery entity.
     *
     * @param PhotoGallery $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(PhotoGallery $entity)
    {

        $form = $this->createForm(new PhotoGalleryType(), $entity, array(
            'action' => $this->generateUrl('gallery_create', array('id' => $entity->getId())),
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
     * Displays a form to create a new PhotoGallery entity.
     *
     */
    public function newAction()
    {
        $entity = new PhotoGallery();
        $form   = $this->createCreateForm($entity);

        return $this->render('SettingMediaBundle:PhotoGallery:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a PhotoGallery entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SettingMediaBundle:PhotoGallery')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PhotoGallery entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SettingMediaBundle:PhotoGallery:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PhotoGallery entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SettingMediaBundle:PhotoGallery')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PhotoGallery entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SettingMediaBundle:PhotoGallery:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a PhotoGallery entity.
    *
    * @param PhotoGallery $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PhotoGallery $entity)
    {

        $form = $this->createForm(new PhotoGalleryType(), $entity, array(
            'action' => $this->generateUrl('gallery_update', array('id' => $entity->getId())),
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
     * Edits an existing PhotoGallery entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SettingMediaBundle:PhotoGallery')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PhotoGallery entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->upload();
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success',"Data has been inserted successfully"
            );
            return $this->redirect($this->generateUrl('gallery_edit', array('id' => $id)));
        }

        return $this->render('SettingMediaBundle:PhotoGallery:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a PhotoGallery entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SettingMediaBundle:PhotoGallery')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PhotoGallery entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('gallery'));
    }

    /**
     * Creates a form to delete a PhotoGallery entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('gallery_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    /**
     * Status a PhotoGallery entity.
     *
     */
    public function statusAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('SettingMediaBundle:PhotoGallery')->find($id);

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
        return $this->redirect($this->generateUrl('gallery'));
    }


}
