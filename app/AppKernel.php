<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new FOS\UserBundle\FOSUserBundle(),
	        new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
	        new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
	        new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
	        new JMS\AopBundle\JMSAopBundle(),
	        new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
	        new JMS\DiExtraBundle\JMSDiExtraBundle($this),

	        new Core\UserBundle\UserBundle(),
            new Slik\DompdfBundle\SlikDompdfBundle(),
            new Setting\Bundle\LocationBundle\SettingLocationBundle(),
            new Setting\Bundle\MediaBundle\SettingMediaBundle(),
            new Setting\Bundle\AppearanceBundle\SettingAppearanceBundle(),
            new Setting\Bundle\ContentBundle\SettingContentBundle(),
            new Setting\Bundle\ToolBundle\SettingToolBundle(),
            new Mobile\SettingsBundle\MobileBundle(),
            new Web\Bundle\SettingBundle\WebSettingBundle(),
            new Syndicate\Bundle\ComponentBundle\SyndicateComponentBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/config/config_' . $this->getEnvironment() . '.yml');
    }

}
