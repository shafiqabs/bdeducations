<?php

namespace Setting\Bundle\ToolBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SiteSettingType extends AbstractType
{

    public  $syndicateId;

    public function __construct($syndicateId)
    {
        $this->syndicateId = $syndicateId;

    }


    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

          $builder


              ->add('webTheme', 'entity', array(
                 'required'    => false,
                 'class' => 'Setting\Bundle\ToolBundle\Entity\WebTheme',
                 'empty_value' => '---Select Web Theme ---',
                 'property' => 'name',
                 'attr'=>array('class'=>'form-control input-sm'),
                 'query_builder' => function(EntityRepository $er){
                         return $er->createQueryBuilder('wt')
                             ->andWhere("wt.status = 1")
                             ->andWhere(':syndicate MEMBER OF wt.syndicates')
                             ->orderBy('wt.name','ASC')
                             ->setParameter('syndicate', $this->syndicateId);
                 },
             ))
             ->add('mobileTheme', 'entity', array(
                 'required'    => false,
                 'class' => 'Setting\Bundle\ToolBundle\Entity\MobileTheme',
                 'empty_value' => '---Select Mobile Theme ---',
                 'property' => 'name',
                 'attr'=>array('class'=>'form-control input-sm'),
                 'query_builder' => function(EntityRepository $er){
                          return $er->createQueryBuilder('mt')
                              ->andWhere("mt.status = 1")
                              ->andWhere(':syndicate MEMBER OF mt.syndicates')
                              ->orderBy('mt.name','ASC')
                              ->setParameter('syndicate', $this->syndicateId);
                 },

              ))

              ->add('syndicateModules', 'entity', array(
                  'required'      => true,
                  'expanded'      =>true,
                  'multiple'      =>true,
                  'class' => 'Setting\Bundle\ToolBundle\Entity\SyndicateModule',
                  'property' => 'name',
                  'attr'=>array('class'=>''),
                  'query_builder' => function(EntityRepository $er){
                          return $er->createQueryBuilder('sm')
                              ->andWhere("sm.status = 1")
                              ->andWhere(':syndicate MEMBER OF sm.syndicates')
                              ->orderBy('sm.name','ASC')
                              ->setParameter('syndicate', $this->syndicateId);
                      },

              ))


              ->add('syndicates', 'entity', array(
                'required'      => true,
                'expanded'      =>true,
                'multiple'      =>true,
                'class' => 'Setting\Bundle\ToolBundle\Entity\Syndicate',
                'property' => 'name',
                'attr'=>array('class'=>''),
                'query_builder' => function(EntityRepository $er){
                        return $er->createQueryBuilder('s')
                            ->andWhere("s.status = 1")
                            ->andWhere("s.parent = $this->syndicateId ")
                            ->orderBy('s.name','ASC');
                    },
            ))



            ->add('modules', 'entity', array(
                'required'      => true,
                'expanded'      =>true,
                'multiple'      =>true,
                'class' => 'Setting\Bundle\ToolBundle\Entity\Module',
                'property' => 'name',
                'attr'=>array('class'=>''),
                'query_builder' => function(EntityRepository $er){
                        return $er->createQueryBuilder('m')
                            ->andWhere("m.status = 1")
                            ->orderBy('m.name','ASC');
                    },
            ))




        ;


    }


    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Setting\Bundle\ToolBundle\Entity\SiteSetting'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'setting_bundle_toolbundle_sitesetting';
    }
}
