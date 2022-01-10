<?php

namespace App\Form;

use App\Entity\Pin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $IsEdit = $options["method"] === "PUT";
        $ImageFileconstraints = [];
        if ($IsEdit) {
            $ImageFileconstraints[] = ['maxSize' => '1K'];

          
            $builder
                ->add('imageFile', VichImageType::class, [
                    'label' => "image ( JPG or PNG file )",
                    'required' => false,
                    'allow_delete' => true,
                    'delete_label' => 'Delete',
                    'download_uri' => false,
                    'constraints' => [
                        new Image($ImageFileconstraints[0])
                    ]
                    /*'image_uri' => true,*/
                    /*  'download_label' => 'Download', */
                    /*  'asset_helper' => true, */
                ])
                ->add('title')
                ->add('description');
        } else {
            $builder
                ->add('imageFile', VichImageType::class, [
                    'label' => "image ( JPG or PNG file )",
                    'required' => false,
                    'allow_delete' => true,
                    'delete_label' => 'Delete',
                    'download_uri' => false,

                    /*'image_uri' => true,*/
                    /*  'download_label' => 'Download', */
                    /*  'asset_helper' => true, */
                ])
                ->add('title')
                ->add('description');
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pin::class,
        ]);
    }
}