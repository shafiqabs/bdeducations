<?php

namespace Setting\Bundle\LocationBundle\Form;

use Setting\Bundle\LocationBundle\Entity\Division;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class DistrictType extends AbstractType
{
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
            ->add('division', 'entity', array(
                'empty_value' => '---Select Division---',
                'required'    => true,
                'attr'=>array('class'=>'division form-control input-sm select2'),
                'class' => 'SettingLocationBundle:Division',
                'property' => 'name'
            ))

            ->add('status')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Setting\Bundle\LocationBundle\Entity\District'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'setting_bundle_locationbundle_district';
    }
}
