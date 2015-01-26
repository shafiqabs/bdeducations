<?php

namespace Setting\Bundle\ContentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class NewsType extends AbstractType
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

            ->add('file','file', array('attr'=>array('class'=>'default')))
            ->add('content','textarea', array('attr'=>array('class'=>'wysihtml5 form-control','rows'=>8)))
            ->add('startDate','date', array('attr'=>array('class'=>''),'years' => range(2025,date('d-m-Y'))))
            ->add('endDate','date', array('attr'=>array('class'=>'')))
            ->add('feature')
            ->add('status')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Setting\Bundle\ContentBundle\Entity\News'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'setting_bundle_contentbundle_news';
    }
}
