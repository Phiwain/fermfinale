<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Carrier;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Webmozart\Assert\Tests\StaticAnalysis\null;
use function Webmozart\Assert\Tests\StaticAnalysis\true;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('addresses', EntityType::class, [
                'label'=> "Choississez votre adresse de livraion",
                'required'=> true,
                'class'=>Address::class,
                'extended'=> true,
                'choices'=>$options['addresses'],
                'label_html'=>true
            ])

            ->add('carriers', EntityType::class, [
            'label'=> "Choississez votre point de livraison",
            'required'=> true,
            'class'=>Carrier::class,
            'extended'=> true,
            'label_html'=>true
    ])
            ->add('submit', SubmitType::class, [
                'label'=> "Valider",
                'attr'=> [
                    'class' => "w-100 btn btn-succes "
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'addresses' =>null
        ]);
    }
}
