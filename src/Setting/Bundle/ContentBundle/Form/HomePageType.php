<?php

namespace Setting\Bundle\ContentBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;

class HomePageType extends AbstractType
{

    private $user;
    private $siteSettingId;

    public function __construct($user,$siteSettingId)
    {
        $this->user = $user;
        $this->siteSettingId = $siteSettingId;

    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {



        $builder
            ->add('name','text', array('attr'=>array('class'=>'form-control input-sm','placeholder'=>'Enter menu group name'),
                'constraints' =>array(
                    new NotBlank(array('message'=>'Please input required')),
                    new Length(array('max'=>200))
                )
            ))
            ->add('file','file', array('attr'=>array('class'=>'default')))
            ->add('content','textarea', array('attr'=>array('class'=>'wysihtml5 form-control','rows'=>15)))
            ->add('photo_gallery', 'entity', array(
                'required'    => false,
                'class' => 'Setting\Bundle\MediaBundle\Entity\PhotoGallery',
                'empty_value' => '---Select Photo Gallery---',
                'property' => 'name',
                'attr'=>array('class'=>'form-control input-sm'),
                'query_builder' => function(EntityRepository $er){
                        return $er->createQueryBuilder('o')
                            ->andWhere("o.status = 1")
                            ->andWhere("o.user = $this->user")
                            ->orderBy('o.name','ASC');
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
                            ->andWhere(':siteSetting MEMBER OF sm.siteSettings')
                            ->orderBy('sm.name','ASC')
                            ->setParameter('siteSetting',$this->siteSettingId);
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
                        return $er->createQueryBuilder('sm')
                            ->andWhere("sm.status = 1")
                            ->andWhere(':siteSetting MEMBER OF sm.siteSettings')
                            ->orderBy('sm.name','ASC')
                            ->setParameter('siteSetting',$this->siteSettingId);
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
                        return $er->createQueryBuilder('sm')
                            ->andWhere("sm.status = 1")
                            ->andWhere(':siteSetting MEMBER OF sm.siteSettings')
                            ->orderBy('sm.name','ASC')
                            ->setParameter('siteSetting',$this->siteSettingId);
                    },

            ))
            ->add('sliderType')
        ;

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Setting\Bundle\ContentBundle\Entity\HomePage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'setting_bundle_contentbundle_homepage';
    }
}
