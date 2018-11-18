<?php declare(strict_types=1);

namespace AppBundle\Form;

use AppBundle\Entity\Account;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, array(
                'choices' => array(
                    Account::ACCOUNT_TYPE_PRIVATE,
                    Account::ACCOUNT_TYPE_BUSINESS,
                ),
                'expanded' => true,
            ))
            ->add('taxcode', TextType::class)
            ->add('contact', ContactType::class)
            ->add('Submit', SubmitType::class, array('label' => 'Create Account'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Account::class,
        ));
    }
}