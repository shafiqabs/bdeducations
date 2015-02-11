<?php

namespace Setting\Bundle\ContentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class BranchType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('name','text', array('attr'=>array('class'=>'form-control input-sm','placeholder'=>'Enter location name'),
                'constraints' =>array(
                    new NotBlank(array('message'=>'Please input required')),

                )
            ))
            ->add('mobile','text', array('attr'=>array('class'=>'form-control input-sm','placeholder'=>'Enter mobile no')

            ))
            ->add('email','text', array('attr'=>array('class'=>'form-control input-sm','placeholder'=>'Enter email address')

            ))
            ->add('phone','text', array('attr'=>array('class'=>'form-control input-sm','placeholder'=>'Enter email phone')

            ))
            ->add('fax','text', array('attr'=>array('class'=>'form-control input-sm','placeholder'=>'Enter email fax')

            ))
            ->add('contactPerson','text', array('attr'=>array('class'=>'form-control input-sm','placeholder'=>'Enter contact person')
            ))
            ->add('address','text', array('attr'=>array('class'=>'form-control input-sm','placeholder'=>'Enter address')))
            ->add('status')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Setting\Bundle\ContentBundle\Entity\Branch'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'setting_bundle_contentbundle_branch';
    }
}
