<?php

namespace Mobile\SettingsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{

    public function indexAction($subdomain,$slug){


        $em = $this->getDoctrine()->getManager();
        $globalOption = $em->getRepository('SettingToolBundle:GlobalOption')->findOneBy(array('subDomain'=>$subdomain));
        $user = $globalOption->getUser();
        $syndicate = $globalOption->getSyndicate()->getEntityName();

        if(!empty($globalOption)){

            $menu = $em->getRepository('SettingAppearanceBundle:Menu')->findOneBy(array('user' => $user ,'menuSlug' => $slug));
            $page ='';
            $moduleName ='';

            if(!empty($menu)){

                $siteEntity = $em->getRepository('SettingToolBundle:SiteSetting')->findOneBy(array('user'=>$user));

                if(!empty($siteEntity) && !empty($siteEntity->getMobileTheme()) ){
                    $themeName = $siteEntity->getMobileTheme()->getFolderName();
                }else{
                    $themeName ='Default';
                }

                $entity = $em->getRepository('SyndicateComponentBundle:'.$syndicate)->findOneBy(array('user'=>$user));

                $menus = $em->getRepository('SettingAppearanceBundle:MenuGrouping')->findBy(array('user'=>$user,'parent'=>NULL,'menuGroup'=>6),array('sorting'=>'asc'));

                $menusTree = $this->get('setting.menuTreeSettingRepo')->getMenuTree($menus,$subdomain);

                if(!empty($this->get('setting.menuTreeSettingRepo')->getModuleTheme($menu))){
                    $moduleName = $this->get('setting.menuTreeSettingRepo')->getModuleTheme($menu);
                    $twigName = "module";
                }else{
                    $page = $em->getRepository('SettingContentBundle:Page')->findOneBy(array('user'=>$user,'menuSlug' => $slug));
                    $twigName = "content";
                }

            }
            $page = ($page) ? $page :'';
            return $this->render('MobileBundle:'.$themeName.':'.$twigName.'.html.twig',
                array(

                    'menu'  => $menusTree,
                    'entity'    => $entity,
                    'page'      => $page,
                    'moduleName'      => $moduleName
                )
            );
        }

    }

    public function contactSubmitAction(Request $request)
    {
        $data = $request->request->all();
        $this->getDoctrine()->getRepository('SettingContentBundle:ContactMessage')->insertMessage($data);
        $referer = $request->headers->get('referer');
        return new RedirectResponse($referer);

    }

    public function blogSubmitAction(Request $request)
    {
        $data = $request->request->all();
        $this->getDoctrine()->getRepository('SettingContentBundle:BlogComment')->insertMessage($data);
        $referer = $request->headers->get('referer');
        return new RedirectResponse($referer);

    }

    public function admissionSubmitAction(Request $request)
    {
        $data = $request->request->all();
        $this->getDoctrine()->getRepository('SettingContentBundle:AdmissionComment')->insertMessage($data);
        $referer = $request->headers->get('referer');
        return new RedirectResponse($referer);

    }


}
