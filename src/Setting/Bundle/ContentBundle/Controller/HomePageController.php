<?php

namespace Setting\Bundle\ContentBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Setting\Bundle\ContentBundle\Entity\HomePage;
use Setting\Bundle\ContentBundle\Form\HomePageType;

/**
 * HomePage controller.
 *
 */
class HomePageController extends Controller
{

    /**
     * Lists all HomePage entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SettingContentBundle:HomePage')->findAll();

        return $this->render('SettingContentBundle:HomePage:index.html.twig', array(
            'entities' => $entities,
        ));
    }


    /**
     * Displays a form to edit an existing HomePage entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SettingContentBundle:HomePage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find HomePage entity.');
        }

        $editForm = $this->createEditForm($entity);
        $menus = $this->getDoctrine()->getRepository('SettingContentBundle:HomeBlock')->getMenuLists($entity->getUser());

        return $this->render('SettingContentBundle:HomePage:edit.html.twig', array(
            'entity'      => $entity,
            'menus'      => $menus,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing HomePage entity.
     *
     */
    public function modifyAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.context')->getToken()->getUser();

        $entity = $em->getRepository('SettingContentBundle:HomePage')->findOneBy(array('user'=>$user));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find HomePage entity.');
        }

        $editForm = $this->createEditForm($entity);
        $menus = $this->getDoctrine()->getRepository('SettingContentBundle:HomeBlock')->getMenuLists($entity->getUser());

        return $this->render('SettingContentBundle:HomePage:edit.html.twig', array(
            'entity'      => $entity,
            'menus'      => $menus,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a HomePage entity.
    *
    * @param HomePage $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(HomePage $entity)
    {

        $siteSettingId = $entity->getUser()->getSiteSetting()->getId();
        $form = $this->createForm(new HomePageType($entity->getUser()->getId(),$siteSettingId), $entity, array(
            'action' => $this->generateUrl('homepage_update', array('id' => $entity->getId())),
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
     * Edits an existing HomePage entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $data = $request->request->all();

        $entity = $em->getRepository('SettingContentBundle:HomePage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find HomePage entity.');
        }


        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->upload();
            $em->flush();

            $this->getDoctrine()->getRepository('SettingContentBundle:HomeBlock')->insertHomeBlock($data,$entity);
            $this->get('session')->getFlashBag()->add(
                'success',"Data has been changed successfully"
            );
            $referer = $request->headers->get('referer');
            return new RedirectResponse($referer);
        }

        return $this->render('SettingContentBundle:HomePage:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()

        ));
    }
}
