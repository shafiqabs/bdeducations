<?php

namespace Setting\Bundle\ToolBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Setting\Bundle\ToolBundle\Entity\GlobalOption;
use Setting\Bundle\ToolBundle\Form\GlobalOptionType;

/**
 * GlobalOption controller.
 *
 */
class GlobalOptionController extends Controller
{

    /**
     * Lists all GlobalOption entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SettingToolBundle:GlobalOption')->findAll();

        return $this->render('SettingToolBundle:GlobalOption:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new GlobalOption entity.
     *
     */
    public function createAction(Request $request)
    {

        $user = $this->get('security.context')->getToken()->getUser();

        $entity = new GlobalOption();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $entity->setUser($user);
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success',"Data has been inserted successfully"
            );

            return $this->redirect($this->generateUrl('globaloption_show', array('id' => $entity->getId())));


        }

        return $this->render('SettingToolBundle:GlobalOption:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a GlobalOption entity.
     *
     * @param GlobalOption $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(GlobalOption $entity)
    {

        $form = $this->createForm(new GlobalOptionType(), $entity, array(
            'action' => $this->generateUrl('globaloption_create', array('id' => $entity->getId())),
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
     * Displays a form to create a new GlobalOption entity.
     *
     */
    public function newAction()
    {
        $entity = new GlobalOption();
        $form   = $this->createCreateForm($entity);

        return $this->render('SettingToolBundle:GlobalOption:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a GlobalOption entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SettingToolBundle:GlobalOption')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GlobalOption entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SettingToolBundle:GlobalOption:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing GlobalOption entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SettingToolBundle:GlobalOption')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GlobalOption entity.');
        }
        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SettingToolBundle:GlobalOption:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a GlobalOption entity.
    *
    * @param GlobalOption $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(GlobalOption $entity)
    {

        $form = $this->createForm(new GlobalOptionType(), $entity, array(
            'action' => $this->generateUrl('globaloption_update', array('id' => $entity->getId())),
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
     * Edits an existing GlobalOption entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SettingToolBundle:GlobalOption')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GlobalOption entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $user = $entity->getUser();
            $this->getDoctrine()->getRepository('SettingToolBundle:SiteSetting')->globalOptionSetting($user);
            $this->getDoctrine()->getRepository('SettingContentBundle:HomePage')->globalOptionHome($user);
            $this->getDoctrine()->getRepository('SettingContentBundle:ContactPage')->globalOptionContact($user);
        }

        $this->get('session')->getFlashBag()->add(
            'success',"Data has been updated successfully"
        );

        $referer = $request->headers->get('referer');
        return new RedirectResponse($referer);

    }
    /**
     * Deletes a GlobalOption entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SettingToolBundle:GlobalOption')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find GlobalOption entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('globaloption'));
    }

    /**
     * Creates a form to delete a GlobalOption entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('globaloption_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }


    /**
     * Displays a form to edit an existing GlobalOption entity.
     *
     */
    public function modifyAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $entity = $em->getRepository('SettingToolBundle:GlobalOption')->findOneBy(array('user'=>$user));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GlobalOption entity.');
        }
        $id = $entity->getId();
        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SettingToolBundle:GlobalOption:modify.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
}
