<?php

namespace Setting\Bundle\ToolBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Setting\Bundle\ToolBundle\Entity\SyndicateModule;
use Setting\Bundle\ToolBundle\Form\SyndicateModuleType;

/**
 * SyndicateModule controller.
 *
 */
class SyndicateModuleController extends Controller
{

    /**
     * Lists all SyndicateModule entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SettingToolBundle:SyndicateModule')->findAll();

        return $this->render('SettingToolBundle:SyndicateModule:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new SyndicateModule entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new SyndicateModule();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $menu = $entity ->getName();
            $slug = $this->get('setting.menuSettingRepo')-> urlSlug($menu);
            $entity ->setMenuSlug($slug);

            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',"Data has been inserted successfully"
            );
            return $this->redirect($this->generateUrl('syndicatemodule_show', array('id' => $entity->getId())));
        }

        return $this->render('SettingToolBundle:SyndicateModule:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SyndicateModule entity.
     *
     * @param SyndicateModule $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SyndicateModule $entity)
    {

        $form = $this->createForm(new SyndicateModuleType(), $entity, array(
            'action' => $this->generateUrl('syndicatemodule_create', array('id' => $entity->getId())),
            'method' => 'POST',
            'attr' => array(
                'class' => 'form-horizontal',
                'novalidate' => 'novalidate',
            )
        ));

        $form->add('submit', 'submit', array('label' => 'Insert', 'attr' => array('class' => 'btn btn-primary')));
        $form->add('reset', 'reset', array('label' => 'Reset', 'attr' => array('class' => 'btn btn-danger')));

        return $form;
    }

    /**
     * Displays a form to create a new SyndicateModule entity.
     *
     */
    public function newAction()
    {
        $entity = new SyndicateModule();
        $form   = $this->createCreateForm($entity);

        return $this->render('SettingToolBundle:SyndicateModule:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SyndicateModule entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SettingToolBundle:SyndicateModule')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SyndicateModule entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SettingToolBundle:SyndicateModule:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SyndicateModule entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SettingToolBundle:SyndicateModule')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SyndicateModule entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SettingToolBundle:SyndicateModule:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a SyndicateModule entity.
    *
    * @param SyndicateModule $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SyndicateModule $entity)
    {
        $form = $this->createForm(new SyndicateModuleType(), $entity, array(
            'action' => $this->generateUrl('syndicatemodule_update', array('id' => $entity->getId())),
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
     * Edits an existing SyndicateModule entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SettingToolBundle:SyndicateModule')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SyndicateModule entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

            $menu = $entity ->getName();
            $slug = $this->get('setting.menuSettingRepo')->urlSlug($menu);
            $entity ->setMenuSlug($slug);

            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',"Data has been changed successfully"
            );
            return $this->redirect($this->generateUrl('syndicatemodule_edit', array('id' => $id)));
        }

        return $this->render('SettingToolBundle:SyndicateModule:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a SyndicateModule entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SettingToolBundle:SyndicateModule')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SyndicateModule entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('syndicatemodule'));
    }

    /**
     * Creates a form to delete a SyndicateModule entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('syndicatemodule_delete', array('id' => $id)))
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
        $entity = $em->getRepository('SettingToolBundle:MobileTheme')->find($id);

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
            'success',"Status has been changed successfully"
        );
        return $this->redirect($this->generateUrl('mobiletheme'));
    }

}
