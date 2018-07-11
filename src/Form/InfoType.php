<?php

namespace App\Form;

use App\Entity\Info;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('commune')
            ->add('centroidx')
            ->add('centroidy')
            ->add('date')
            ->add('echeance')
            ->add('indiceno2')
            ->add('indiceo3')
            ->add('indicepm10')
            ->add('indiceso2')
            ->add('qualiteair')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Info::class,
        ]);
    }
}
