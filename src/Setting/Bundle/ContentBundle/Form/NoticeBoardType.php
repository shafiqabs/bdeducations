<?php

namespace Setting\Bundle\ContentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class NoticeBoardType extends AbstractType
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
                    new NotBlank(array('message'=>'Please input required'))

                )
            ))
            ->add('content','textarea', array('attr'=>array('class'=>'wysihtml5 form-control','rows'=>8)))
            ->add('status')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Setting\Bundle\ContentBundle\Entity\NoticeBoard'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'setting_bundle_contentbundle_noticeboard';
    }
}
