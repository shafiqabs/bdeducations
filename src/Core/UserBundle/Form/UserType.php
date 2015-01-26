<?php

namespace Core\UserBundle\Form;

use Doctrine\ORM\EntityRepository;

use Core\UserBundle\Form\Type\ProfileFormType;
use Setting\Bundle\ToolBundle\Entity\Syndicate;
use Setting\Bundle\ToolBundle\Form\GlobalOptionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends BaseType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       // var_dump($options['data']->getId());

        parent::buildForm($builder, $options);
        $builder
        ->add('name','text', array('attr'=>array('class'=>'form-control input-sm','placeholder'=>'Enter your full name'),
        'constraints' =>array(
            new NotBlank(array('message'=>'Please input required')),
            new Length(array('max'=>200))
        )))
        ->add('username','text', array('attr'=>array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle' , 'class'=>'form-control input-sm','placeholder'=>'Enter your user name'),
        'constraints' =>array(
            new NotBlank(array('message'=>'Please input required')),
            new Length(array('max'=>200))
        )))
        ->add('email','email', array('attr'=>array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle' , 'class'=>'form-control input-sm','placeholder'=>'Enter your email address'),
        'constraints' =>array(
            new NotBlank(array('message'=>'Please input required')),
            new Length(array('max'=>200))
        )))
        ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch'
        ));

	    $builder->add('profile', new ProfileFormType());
	    $builder->add('globalOption', new GlobalOptionType());
	    //$builder->add('groups', new GlobalOptionType());

    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Core\UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'user';
    }
}