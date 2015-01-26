<?php

namespace Setting\Bundle\ContentBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Setting\Bundle\Appearance\Service\RequestManager;
use Setting\Bundle\ContentBundle\Entity\Page;
use Setting\Bundle\ContentBundle\Form\PageType;

/**
 * Page controller.
 *
 */
class PageController extends Controller
{

    /**
     * Lists all Page entities.
     *
     */
    public function listingAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SettingContentBundle:Page')->findBy(array(),array('name' => 'asc'));

        return $this->render('SettingContentBundle:Page:index.html.twig', array(
            'pagination' => $entities,
        ));
    }
    /**
     * Lists all Delete Page entities.
     *
     */
    public function listingDeleteAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SettingContentBundle:Page')->findBy(array(),array('name' => 'asc'));

        return $this->render('SettingContentBundle:Page:index.html.twig', array(
            'pagination' => $entities,
        ));
    }

    /**
     * Lists Spacific user  Page entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.context')->getToken()->getUser();

        $entities = $em->getRepository('SettingContentBundle:Page')->findBy(array('user' => $user),array('name' => 'asc'));

        return $this->render('SettingContentBundle:Page:index.html.twig', array(
            'pagination' => $entities,
        ));
    }
    /**
     * Creates a new Page entity.
     *
     */

    public function createAction(Request $request)
    {


        $user = $this->get('security.context')->getToken()->getUser();

        $entity = new Page();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $menu = $entity->getMenu();
            $parent = $entity->getParent();
            if($parent){
                $subPage = array($parent);
                $entity ->setSubPages($subPage);
            }
            $slug = $this->get('setting.menuSettingRepo')-> urlSlug($menu);
            $entity ->setMenuSlug($slug);
            $entity ->setUser($user);
            $entity ->upload();
            $em->persist($entity);
            $em->flush();

            $this->getDoctrine()->getRepository('SettingContentBundle:Page')->insertPageMenu($entity->getId());

            $this->get('session')->getFlashBag()->add(
                'success',"Data has been inserted successfully"
            );
            return $this->redirect($this->generateUrl('page_show', array('id' => $entity->getId())));
        }

        return $this->render('SettingContentBundle:Page:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Page entity.
     *
     * @param Page $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Page $entity)
    {

        $user = $this->get('security.context')->getToken()->getUser();

        $form = $this->createForm(new PageType($user -> getId()), $entity, array(
            'action' => $this->generateUrl('page_create', array('id' => $entity->getId())),
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
     * Displays a form to create a new Page entity.
     *
     */
    public function newAction()
    {
        $entity = new Page();
        $form   = $this->createCreateForm($entity);

        return $this->render('SettingContentBundle:Page:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Page entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SettingContentBundle:Page')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SettingContentBundle:Page:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Page entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SettingContentBundle:Page')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SettingContentBundle:Page:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Page entity.
     *
     * @param Page $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Page $entity)
    {

        $form = $this->createForm(new PageType($entity->getUser()->getId()), $entity, array(
            'action' => $this->generateUrl('page_update', array('id' => $entity->getId())),
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
     * Edits an existing Page entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SettingContentBundle:Page')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

            $menu = $entity->getMenu();
            $parent = $entity->getParent();
            if($parent){
                $subPage = array($parent);
                $entity ->setSubPages($subPage);
            }

            $slug = $this->get('setting.menuSettingRepo')->urlSlug($menu);
            $entity ->setMenuSlug($slug);

            $entity->upload();
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',"Data has been updated successfully"
            );

            $this->getDoctrine()->getRepository('SettingContentBundle:Page')->updatePageMenu($entity->getId());

            return $this->redirect($this->generateUrl('page_edit', array('id' => $id)));
        }

        return $this->render('SettingContentBundle:Page:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Page entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SettingContentBundle:Page')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Page entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('page'));
    }

    /**
     * Creates a form to delete a Page entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('page_delete', array('id' => $id)))
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

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('SettingContentBundle:Page')->find($id);

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
        return $this->redirect($this->generateUrl('page'));
    }

}
