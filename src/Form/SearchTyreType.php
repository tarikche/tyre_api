<?php

namespace App\Form;

use App\Entity\Tyre;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchTyreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('width', ChoiceType::class, [
                'choices' => $this->getTireWidthsFromDatabase(),
                'label' => 'Width',
                'attr' => [
                    'class' => 'bg-red border border-gray-300 p-2 rounded-md w-full focus:outline-none focus:border-blue-500 ml-24',
                    'placeholder' => 'Enter diameter or select from the list',
                ],
            ])
            ->add('height', ChoiceType::class, [
                'choices' => $this->getTireHeightsFromDatabase(),
                'label' => 'Height',
                'attr' => [
                    'class' => 'bg-red border border-gray-300 p-2 rounded-md w-full focus:outline-none focus:border-blue-500',
                    'placeholder' => 'Enter diameter or select from the list',
                ],
            ])
            ->add('diameter', ChoiceType::class, [
                'choices' => $this->getTireDiametersFromDatabase(),
                'label' => 'Diameter',
                'attr' => [
                    'class' => 'bg-red border border-gray-300 p-2 rounded-md w-full focus:outline-none focus:border-blue-500',
                    'placeholder' => 'Enter diameter or select from the list',
                ],
            ])
            ->add('season', ChoiceType::class, [
                'choices' => $this->getTireSeasonsFromDatabase(),
                'label' => 'Season',
                'attr' => [
                    'class' => 'bg-red border border-gray-300 p-2 rounded-md w-full focus:outline-none focus:border-blue-500  ',
                    'placeholder' => 'Enter diameter or select from the list',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Search',
                'attr' => [
                    'class' => 'bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded',
                ],
            ]);
    }


    

        
    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tyre::class,
        ]);
    }


    // Replace the methods below with the logic to fetch the values from your database
    private function getTireDiametersFromDatabase()
    {
        // Replace this with your logic to fetch the tire diameters from the database
        return ['15 inches' => '15', '16 inches' => '16', '17 inches' => '17'];
    }

    private function getTireHeightsFromDatabase()
    {
        // Replace this with your logic to fetch the tire heights from the database
        return ['50' => '50', '55' => '55', '60' => '60'];
    }

    private function getTireWidthsFromDatabase()
    {
        // Replace this with your logic to fetch the tire widths from the database
        return ['205' => '205', '215' => '215', '225' => '225'];
    }

    private function getTireSeasonsFromDatabase()
    {
        // Replace this with your logic to fetch the tire seasons from the database
        return ['Summer' => 'Summer', 'Winter' => 'Winter', 'All-Season' => 'All-Season'];
    }
}
