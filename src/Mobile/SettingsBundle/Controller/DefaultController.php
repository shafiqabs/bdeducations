<?php

namespace Mobile\SettingsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction($subdomain)
    {

        $em = $this->getDoctrine()->getManager();
        $globalOption = $em->getRepository('SettingToolBundle:GlobalOption')->findOneBy(array('subDomain'=>$subdomain));
        $user = $globalOption->getUser();
        $syndicate = $globalOption->getSyndicate()->getEntityName();

        if(!empty($globalOption)){


            $menus = $em->getRepository('SettingAppearanceBundle:MenuGrouping')->findBy(array('user'=>$user,'parent'=>NULL,'menuGroup'=>6),array('sorting'=>'asc'));
            $menusTree = $this->get('setting.menuTreeSettingRepo')->getMenuTree($menus,$subdomain);

            $siteEntity = $em->getRepository('SettingToolBundle:SiteSetting')->findOneBy(array('user'=>$user));
            if(!empty($siteEntity) && !empty($siteEntity->getMobileTheme() ) ){
                $themeName = $siteEntity->getMobileTheme()->getFolderName();
            }else{
                $themeName ='Default';
            }

            $entity = $em->getRepository('SyndicateComponentBundle:'.$syndicate)->findOneBy(array('user'=>$user));
            if($globalOption->getIsIntro() == 1 ){
                $page = 'index';
            }else{
                $page = 'home';
            }
            return $this->render('MobileBundle:'.$themeName.':'.$page.'.html.twig',
                array(

                    'menu'  => $menusTree,
                    'entity'    => $entity

                )
            );

        }else{

            return $this->redirect($this->generateUrl('homepage'));

        }
    }

    public function homeAction($subdomain){

        $em = $this->getDoctrine()->getManager();
        $globalOption = $em->getRepository('SettingToolBundle:GlobalOption')->findOneBy(array('subDomain'=>$subdomain));
        $user = $globalOption->getUser();
        $syndicate = $globalOption->getSyndicate()->getEntityName();

        if(!empty($globalOption)){


            $menus = $em->getRepository('SettingAppearanceBundle:MenuGrouping')->findBy(array('user'=>$user,'parent'=>NULL,'menuGroup'=>6),array('sorting'=>'asc'));
            $menusTree = $this->get('setting.menuTreeSettingRepo')->getMenuTree($menus,$subdomain);

            $siteEntity = $em->getRepository('SettingToolBundle:SiteSetting')->findOneBy(array('user'=>$user));
            if(!empty($siteEntity) && !empty($siteEntity->getMobileTheme() ) ){
                $themeName = $siteEntity->getMobileTheme()->getFolderName();
            }else{
                $themeName ='Default';
            }

            $entity = $em->getRepository('SyndicateComponentBundle:'.$syndicate)->findOneBy(array('user'=>$user));
            return $this->render('MobileBundle:'.$themeName.':home.html.twig',
                array(

                    'menu'  => $menusTree,
                    'entity'    => $entity

                )
            );
        }

    }

    public function contactAction($subdomain){


        $em = $this->getDoctrine()->getManager();
        $globalOption = $em->getRepository('SettingToolBundle:GlobalOption')->findOneBy(array('subDomain'=>$subdomain));
        $user = $globalOption->getUser();
        $syndicate = $globalOption->getSyndicate()->getEntityName();

        if(!empty($globalOption)){


            $menus = $em->getRepository('SettingAppearanceBundle:MenuGrouping')->findBy(array('user'=>$user,'parent'=>NULL,'menuGroup'=>6),array('sorting'=>'asc'));
            $menusTree = $this->get('setting.menuTreeSettingRepo')->getMenuTree($menus,$subdomain);

            $siteEntity = $em->getRepository('SettingToolBundle:SiteSetting')->findOneBy(array('user'=>$user));
            if(!empty($siteEntity) && !empty($siteEntity->getMobileTheme() ) ){
                $themeName = $siteEntity->getMobileTheme()->getFolderName();
            }else{
                $themeName ='Default';
            }

            $entity = $em->getRepository('SyndicateComponentBundle:'.$syndicate)->findOneBy(array('user'=>$user));
            return $this->render('MobileBundle:'.$themeName.':contact.html.twig',
                array(

                    'menu'  => $menusTree,
                    'entity'    => $entity

                )
            );
        }

    }
    public function mapsAction($subdomain){


        $em = $this->getDoctrine()->getManager();
        $globalOption = $em->getRepository('SettingToolBundle:GlobalOption')->findOneBy(array('subDomain'=>$subdomain));
        $user = $globalOption->getUser();
        $syndicate = $globalOption->getSyndicate()->getEntityName();

        if(!empty($globalOption)){


            $menus = $em->getRepository('SettingAppearanceBundle:MenuGrouping')->findBy(array('user'=>$user,'parent'=>NULL,'menuGroup'=>6),array('sorting'=>'asc'));
            $menusTree = $this->get('setting.menuTreeSettingRepo')->getMenuTree($menus,$subdomain);

            $siteEntity = $em->getRepository('SettingToolBundle:SiteSetting')->findOneBy(array('user'=>$user));
            if(!empty($siteEntity) && !empty($siteEntity->getMobileTheme() ) ){
                $themeName = $siteEntity->getMobileTheme()->getFolderName();
            }else{
                $themeName ='Default';
            }

            $entity = $em->getRepository('SyndicateComponentBundle:'.$syndicate)->findOneBy(array('user'=>$user));
            return $this->render('MobileBundle:'.$themeName.':maps.html.twig',
                array(

                    'menu'  => $menusTree,
                    'entity'    => $entity

                )
            );
        }

    }

    public function moduleContentAction($subdomain,$module,$id){

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('SettingContentBundle:'.$module)->find($id);

        echo '<img class="responsive-image" src="/'.$entity->getWebpath().'">';
        echo $entity->getContent();
        exit;

    }
}
