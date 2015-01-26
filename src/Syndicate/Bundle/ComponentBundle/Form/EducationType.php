<?php

namespace Syndicate\Bundle\ComponentBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class EducationType extends AbstractType
{


    private $user;

    public function __construct($user)
    {
        $this->user = $user;

    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text', array('attr'=>array('class'=>'form-control input-sm','placeholder'=>'Enter Name'),
                'constraints' =>array(
                    new NotBlank(array('message'=>'Please input required')),
                    new Length(array('max'=>200))
                )
            ))

            ->add('establishment','date', array('attr'=>array('class'=>'input-sm'),'years' => range(1850, date('Y'))))

            ->add('instituteCheif','text', array('attr'=>array('class'=>'form-control input-sm','placeholder'=>'Enter Institute Cheif'),
                'constraints' =>array(
                    new NotBlank(array('message'=>'Please input required')),
                    new Length(array('max'=>200))
                )
            ))
            ->add('instituteCheifDesignation','text', array('attr'=>array('class'=>'form-control input-sm','placeholder'=>'Enter institute cheif designation'),
                'constraints' =>array(
                    new NotBlank(array('message'=>'Please input required')),
                    new Length(array('max'=>200))
                )
            ))
            ->add('address','text', array('attr'=>array('class'=>'form-control input-sm','placeholder'=>'Enter address'),
                'constraints' =>array(
                    new NotBlank(array('message'=>'Please input required')),
                    new Length(array('max'=>200))
                )
            ))
            ->add('hotline','text', array('attr'=>array('class'=>'form-control input-sm','placeholder'=>'Enter hot line'),
                'constraints' =>array(
                    new NotBlank(array('message'=>'Please input required'))

                )
            ))
            ->add('phone','text', array('attr'=>array('class'=>'form-control input-sm','placeholder'=>'Enter phone')))
            ->add('fax','text', array('attr'=>array('class'=>'form-control input-sm','placeholder'=>'Enter fax')))
            ->add('website','text', array('attr'=>array('class'=>'form-control input-sm','placeholder'=>'Enter website')))
            ->add('website','text', array('attr'=>array('class'=>'form-control input-sm','placeholder'=>'Enter website')))
            ->add('website','text', array('attr'=>array('class'=>'form-control input-sm','placeholder'=>'Enter website')))
            ->add('email','text', array('attr'=>array('class'=>'form-control input-sm','placeholder'=>'Enter email')))
            ->add('contactPerson','text', array('attr'=>array('class'=>'form-control input-sm','placeholder'=>'Enter contact person')))
            ->add('contactPersonDesignation','text', array('attr'=>array('class'=>'form-control input-sm','placeholder'=>'Enter contact person designation')))
            ->add('file','file', array('attr'=>array('class'=>'input-sm','placeholder'=>'Enter contact person designation')))
            ->add('thana', 'entity', array(
                'empty_value' => '---Select Thana/Upazila---',
                'required'    => true,
                'attr'=>array('class'=>'thana form-control input-sm select2'),
                'class' => 'SettingLocationBundle:Thana',
                'property' => 'name'
            ))
            ->add('district', 'entity', array(
                'empty_value' => '---Select District---',
                'required'    => true,
                'attr'=>array('class'=>'district form-control input-sm select2'),
                'class' => 'SettingLocationBundle:District',
                'property' => 'name'
            ))
            ->add('gallery', 'entity', array(
                'required'    => false,
                'class' => 'Setting\Bundle\MediaBundle\Entity\PhotoGallery',
                'empty_value' => '---Select Photo Gallery---',
                'property' => 'name',
                'attr'=>array('class'=>'form-control input-sm'),
                'query_builder' => function(EntityRepository $er){
                        return $er->createQueryBuilder('o')
                            ->andWhere("o.status = 1")
                            ->andWhere("o.user = $this->user ")
                            ->orderBy('o.name','ASC');
                    },
            ))

            ->add('overview','textarea', array('attr'=>array('class'=>'form-control wysihtml5','row'=>'15')))
            ->add('status')
        ;

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Syndicate\Bundle\ComponentBundle\Entity\Education'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'syndicate_bundle_componentbundle_education';
    }
}
