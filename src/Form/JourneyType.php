<?php

namespace App\Form;

use App\Entity\Country;
use App\Entity\Destination;
use App\Entity\Journey;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Test\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JourneyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('duration', null, array(
                'label' => 'Durée',
                'attr' => [
                    'class' => 'row mx-0 my-3 my-md-2 form-control journey-input'
                ]
            ))
            ->add('difficulty', ChoiceType::class, array(
                'choices'  => [
                    '' => '',
                    'facile' => 'facile',
                    'moyen' => 'moyen',
                    'difficile' => 'difficile',
                    'expert' => 'expert',
                ],
                'label' => 'Difficulté',
                'attr' => [
                    'class' => 'row mx-0 my-3 my-md-2 form-control journey-input'
                ]
            ))
            ->add('picture', TextType::class,  array(
                'label' => 'Photo',
                'attr' => [
                    'class' => 'row mx-0 my-3 my-md-2 form-control journey-input'
                ]
            ))
            ->add('name', TextType::class,  array(
                'label' => 'Nom',
                'attr' => [
                    'class' => 'row mx-0 my-3 my-md-2 form-control journey-input'
                ]
            ))
            /*->add('cyclist', null, array (
                'choice_label' => 'username',
                'label' => 'Cycliste',
                'attr' => [
                    'placeholder' => 'Cycliste',
                    'class' => 'row mx-0 my-3 my-md-2 form-control journey-input'
                ]
            ))*/
            ->add('country', EntityType::class, array (
                'class' => Country::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => true,
                'label' => 'Pays',
                'attr' => [
                    'class' => 'row mx-0 my-3 my-md-2 d-flex form-control journey-input'
                ]
            ))
            ->add('region', TextType::class,  array(
                'label' => 'Région',
                'attr' => [
                    'class' => 'row mx-0 my-3 my-md-2 form-control journey-input'
                ]
            ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Journey::class,
        ]);
    }
}
