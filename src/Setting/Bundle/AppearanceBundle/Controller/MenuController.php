<?php

namespace Setting\Bundle\AppearanceBundle\Controller;

use Setting\Bundle\AppearanceBundle\Entity\Menu;
use Setting\Bundle\AppearanceBundle\Form\MenuType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Menu controller.
 *
 */
class MenuController extends Controller
{

    /**
     * Lists all GlobalOption entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SettingToolBundle:GlobalOption')->findAll();

        return $this->render('SettingAppearanceBundle:Menu:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Lists all Menu manage entities.
     *
     */
    public function menuManageAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('SettingAppearanceBundle:Menu')->findBy(array('user'=>$id));
        $form = $this->createEditForm($id);
        return $this->render('SettingAppearanceBundle:Menu:edit.html.twig', array(
            'entities' => $entities,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Lists all menu modify entities.
     *
     */
    public function modifyAction()
    {
        $em = $this->getDoctrine()->getManager();
        $id = $this->get('security.context')->getToken()->getUser()->getId();
        $entities = $em->getRepository('SettingAppearanceBundle:Menu')->findBy(array('user'=>$id));
        $form = $this->createEditForm($id);
        return $this->render('SettingAppearanceBundle:Menu:edit.html.twig', array(
            'entities' => $entities,
            'form'   => $form->createView(),
        ));
    }


    /**
     * Creates a form to edit a Menu entity.
     *
     * @param Menu $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm($id)
    {
        $form = $this->createForm(new MenuType(), Null, array(
            'action' => $this->generateUrl('menu_update', array('id' => $id)),
            'method' => 'PUT',
            'attr' => array(
                'class' => 'form-horizontal',
                'novalidate' => 'novalidate',
            )
        ));

        $form->add('submit', 'submit', array('label' => 'Save', 'attr' => array('class' => 'btn btn-primary')));
        $form->add('reset', 'reset', array('label' => 'Reset', 'attr' => array('class' => 'btn btn-danger')));


        return $form;
    }


    /**
     * Edits an existing MenuGroup entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $data = $request->request->all();
        $this->getDoctrine()->getRepository('SettingAppearanceBundle:Menu')->updateMenu($data);
        $this->get('session')->getFlashBag()->add(
            'success',"Status has been changed successfully"
        );
        $referer = $request->headers->get('referer');
        return new RedirectResponse($referer);
    }


    /**
     * Status a Page entity.
     *
     */
    public function stopMenuAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('SettingToolBundle:GlobalOption')->find($id);

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
        return $this->redirect($this->generateUrl('menu'));
    }

    /**
     * Status a Page entity.
     *
     */
    public function statusAction($user,$id)
    {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('SettingAppearanceBundle:Menu')->find($id);

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
        return $this->redirect($this->generateUrl('menu_manage',array('id' => $user)));
    }





}
