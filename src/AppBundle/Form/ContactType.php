<?php declare(strict_types=1);

namespace AppBundle\Form;

use AppBundle\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        /* 'by_reference' => false*/

        $builder
            ->add('name', TextType::class)
            ->add('surname', TextType::class)
            ->add('phones', CollectionType::class, array(
                'entry_type' => PhoneType::class,
                'entry_options' => array('label' => false),
                'allow_add' => true
            ))

            ->add('addresses', CollectionType::class, array(
                'entry_type' => AddressType::class,
                'entry_options' => array('label' => false),
                'allow_add' => true
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Contact::class,
        ));
    }
}