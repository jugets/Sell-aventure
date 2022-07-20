<?php

namespace App\Form;

use App\Entity\Destination;
use App\Entity\Journey;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Test\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JourneyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('duration')
            ->add('difficulty')
            ->add('pictures')
            ->add('name')
            ->add('cyclist', null, ['choice_label' => 'username'])
            ->add('destinations', EntityType::class, [
                'class' => Destination::class,
                'choice_label' => 'country',
                'multiple' => true,
                'expanded' => true,
            ])->addEventListener(
                FormEvents::PRE_SET_DATA,
                function (FormEvent $event) {
                    $form = $event->getForm();
                    $data = $event->getData();
                    $countries = [];
                    $destinations = $data->getDestinations();
    
                    foreach ($destinations as $destination) {
                        $regions = $destination->getRegions();
                        $form->add('destinations', null,[
                            'choices' => $regions,
                        ]);
                    }
                    
                }
            );;
            

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                $form = $event->getForm();
                $data = $event->getData();
                $countries = [];
                $destinations = $data->getDestinations();

                foreach ($destinations as $destination) {
                    $regions = $destination->getRegions();
                    $form->add('regions', null,[
                        'choices' => $regions,
                    ]);
                }
                
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Journey::class,
        ]);
    }
}
