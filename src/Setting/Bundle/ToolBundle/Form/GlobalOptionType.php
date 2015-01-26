<?php

namespace Setting\Bundle\ToolBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class GlobalOptionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        //$syndicate = ($options['data']->getSyndicate())? $options['data']->getSyndicate()->getId():0;
        $userID = (!empty($options['data'])) ? $options['data']->getId():0;

        if($userID > 0){
            $builder
                ->add('domain','text', array('attr'=>array('class'=>'form-control input-sm','placeholder'=>'Enter domain name'),
                    'constraints' =>array(
                        new NotBlank(array('message'=>'Please input required')),
                        new Length(array('max'=>200))
                    )
                ))
                ->add('subDomain','text', array('attr'=>array('class'=>'form-control input-sm','placeholder'=>'Enter sub-domain name'),
                    'constraints' =>array(
                        new NotBlank(array('message'=>'Please input required')),
                        new Length(array('max'=>200))
                    )
                ))

                ->add('facebookPageUrl','text', array('attr'=>array('class'=>'form-control input-sm')))
                ->add('customizeDesign')
                ->add('isMobile')
                ->add('facebookAds')
                ->add('facebookApps')
                ->add('promotion')
                ->add('cart')
                ->add('isIntro')
            ;
        }else{

            $builder ->add('syndicate', 'entity', array(
                'required'    => true,
                'class' => 'Setting\Bundle\ToolBundle\Entity\Syndicate',
                'empty_value' => '---Select Syndicate ---',
                'property' => 'name',
                'attr'=>array('class'=>'form-control input-sm'),
                'query_builder' => function(EntityRepository $er){
                        return $er->createQueryBuilder('s')
                            ->andWhere("s.status = 1")
                            ->andWhere("s.isParent = 1")
                            ->orderBy('s.name','ASC');
                    },
            ));
        }

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Setting\Bundle\ToolBundle\Entity\GlobalOption'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'setting_bundle_toolbundle_globaloption';
    }
}
