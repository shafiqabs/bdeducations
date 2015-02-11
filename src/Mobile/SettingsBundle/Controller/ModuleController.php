<?php

namespace Mobile\SettingsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;

class ModuleController extends Controller
{

    public function indexAction($subdomain,$module,$slug){


        $em = $this->getDoctrine()->getManager();
        $globalOption = $em->getRepository('SettingToolBundle:GlobalOption')->findOneBy(array('subDomain'=>$subdomain));
        $user = $globalOption->getUser();
        $syndicate = $globalOption->getSyndicate()->getEntityName();

        if(!empty($globalOption)){

            if($module =='syndicate'){
                $menu = $em->getRepository('SettingAppearanceBundle:Menu')->findOneBy(array('user' => $user ,'menuSlug' => $slug));
            }else{
                $menu = $em->getRepository('SettingAppearanceBundle:Menu')->findOneBy(array('user' => $user ,'menuSlug' => $module));
            }

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

                if($this->get('setting.menuTreeSettingRepo')->getModuleTheme($menu)){

                    $moduleName = $this->get('setting.menuTreeSettingRepo')->getModuleTheme($menu);
                    $details = $em->getRepository('SettingContentBundle:'.$moduleName)->findOneBy(array('user'=>$user,'slug' => $slug));
                    $twigName = "module";
                    $fieldName = strtolower($moduleName);
                    if($fieldName == 'blog'){
                        $comment = $em->getRepository('SettingContentBundle:'.$moduleName.'Comment')->findBy(array($fieldName =>$details,'status'=>1));
                        if($comment){
                            $comments = $comment;
                        }else{
                            $comments='';
                        }

                    }else{
                        $comments='';
                    }

                }else{

                    $page = $em->getRepository('SettingContentBundle:Page')->findOneBy(array('user'=>$user,'menuSlug' => $module));
                    $twigName = "content";
                    $details = "";
                    $comments = "";

                }
            }
            $page = ($page) ? $page :'';
            return $this->render('MobileBundle:'.$themeName.':'.$twigName.'Details.html.twig',
                array(

                    'menu'          => $menusTree,
                    'entity'        => $entity,
                    'page'          => $page,
                    'details'       => $details,
                    'comments'       => $comments,
                    'moduleName'    => $moduleName
                )
            );
        }



    }

    public function eventAction($subdomain)
    {


        header('Content-type: text/json');
        echo '[';
        $separator = "";
        $days = 16;
        echo '	{ "date": "1314579600000", "type": "meeting", "title": "Test Last Year", "description": "Lorem Ipsum dolor set", "url": "http://www.event3.com/" },';
        echo '	{ "date": "1377738000000", "type": "meeting", "title": "Test Next Year", "description": "Lorem Ipsum dolor set", "url": "http://www.event3.com/" },';
        for ($i = 1 ; $i < $days; $i= 1 + $i * 2) {
            echo $separator;
            $initTime = (intval(microtime(true))*1000) + (86400000 * ($i-($days/2)));
            echo '	{ "date": "'; echo $initTime; echo '", "type": "meeting", "title": "Project '; echo $i; echo ' meeting", "description": "Lorem Ipsum dolor set", "url": "http://www.event1.com/" },';
            echo '	{ "date": "'; echo $initTime+3600000; echo '", "type": "demo", "title": "Project '; echo $i; echo ' demo", "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.", "url": "http://www.event2.com/" },';
            echo '	{ "date": "'; echo $initTime-7200000; echo '", "type": "meeting", "title": "Test Project '; echo $i; echo ' Brainstorming", "description": "Lorem Ipsum dolor set", "url": "http://www.event3.com/" },';
            echo '	{ "date": "'; echo $initTime+10800000; echo '", "type": "test", "title": "A very very long name for a f*cking project '; echo $i; echo ' events", "description": "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam.", "url": "http://www.event4.com/" },';
            echo '	{ "date": "'; echo $initTime+1800000; echo '", "type": "meeting", "title": "Project '; echo $i; echo ' meeting", "description": "Lorem Ipsum dolor set", "url": "http://www.event5.com/" },';
            echo '	{ "date": "'; echo $initTime+3600000+2592000000; echo '", "type": "demo", "title": "Project '; echo $i; echo ' demo", "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.", "url": "http://www.event6.com/" },';
            echo '	{ "date": "'; echo $initTime-7200000+2592000000; echo '", "type": "meeting", "title": "Test Project '; echo $i; echo ' Brainstorming", "description": "Lorem Ipsum dolor set", "url": "http://www.event7.com/" },';
            echo '	{ "date": "'; echo $initTime+10800000+2592000000; echo '", "type": "test", "title": "A very very long name for a f*cking project '; echo $i; echo ' events", "description": "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam.", "url": "http://www.event8.com/" },';
            echo '	{ "date": "'; echo $initTime+3600000-2592000000; echo '", "type": "demo", "title": "Project '; echo $i; echo ' demo", "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.", "url": "http://www.event9.com/" },';
            echo '	{ "date": "'; echo $initTime-7200000-2592000000; echo '", "type": "meeting", "title": "Test Project '; echo $i; echo ' Brainstorming", "description": "Lorem Ipsum dolor set", "url": "http://www.event10.com/" },';
            echo '	{ "date": "'; echo $initTime+10800000-2592000000; echo '", "type": "test", "title": "A very very long name for a f*cking project '; echo $i; echo ' events", "description": "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam.", "url": "http://www.event11.com/" }';
            $separator = ",";
        }
        echo ']';

       // return new Response($data);
    }

}
