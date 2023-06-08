<?php

namespace App\Form;

use App\Entity\Ride;
use App\Entity\Rule;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RideType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $user = $options['user'];

        $builder
            ->add('departure')
            ->add('destination')
            ->add('seats')
            ->add('price')
            ->add('date')
            ->add('rules', EntityType::class, [
                'class' => Rule::class,
                'multiple' => true,
                'expanded' => true,
                'choice_label' => 'name',
                'by_reference' => false,
                'query_builder' => function (EntityRepository $er) use ($user) {
                    return $er->createQueryBuilder('r')
                        ->where('r.author = :user')
                        ->setParameter('user', $user);
                },
            ])
        ;
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ride::class,
            'user' => null
        ]);
    }
}
