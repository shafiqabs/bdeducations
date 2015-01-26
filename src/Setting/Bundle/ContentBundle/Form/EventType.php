<?php

namespace Setting\Bundle\ContentBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class EventType extends AbstractType
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
            ->add('photo_gallery', 'entity', array(
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

            ->add('status')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Setting\Bundle\ContentBundle\Entity\Event'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'setting_bundle_contentbundle_event';
    }
}
