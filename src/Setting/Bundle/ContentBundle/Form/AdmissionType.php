<?php

namespace Setting\Bundle\ContentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class AdmissionType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text', array('attr'=>array('class'=>'form-control input-sm','placeholder'=>'Enter title'),
                'constraints' =>array(
                    new NotBlank(array('message'=>'Please input required')),

                )
            ))
            ->add('contactPerson','text', array('attr'=>array('class'=>'form-control input-sm','placeholder'=>'Enter contact person'),
                'constraints' =>array(
                    new NotBlank(array('message'=>'Please input required')),

                )
            ))
            ->add('mobileNo','text', array('attr'=>array('class'=>'form-control input-sm','placeholder'=>'Enter mobile no'),
                'constraints' =>array(
                    new NotBlank(array('message'=>'Please input required')),

                )
            ))
            ->add('email','text', array('attr'=>array('class'=>'form-control input-sm','placeholder'=>'Enter email address'),
                'constraints' =>array(
                    new NotBlank(array('message'=>'Please input required')),

                )
            ))
            ->add('content','textarea', array('attr'=>array('class'=>'wysihtml5 form-control','rows'=>8)))
            ->add('address','textarea', array('attr'=>array('class'=>'form-control','rows'=>3)))
            ->add('file','file', array('attr'=>array('class'=>'default')))
            ->add('startDate','date', array('attr'=>array('class'=>'')))
            ->add('endDate','date', array('attr'=>array('class'=>'')))
            ->add('status')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Setting\Bundle\ContentBundle\Entity\Admission'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'setting_bundle_contentbundle_admission';
    }
}
