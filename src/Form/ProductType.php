<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
// ...
            ->add('nom', TextType::class,
                array('attr' => array('class' => 'form-control','style' => ''),'required'=>true))
            ->add('prix', TextType::class, array('attr' => array('class' => 'form-control','style' => '')))
            ->add('url', TextType::class, array('attr' => array('class' => 'form-control','style' => '')))
            ->add('image', FileType::class, [
                'label' => 'Image',
// unmapped means that this field is not associated to any entity property
                'mapped' => false,
// make it optional so you don't have to re-upload the PDF file
// every time you edit the Product details
                'required' => false,

// unmapped fields can't define their validation using annotations
// in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '5024k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpg',
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid img extension',
                    ])
                ]
            ])
            ->add('save', SubmitType::class, ['label' => 'Sauvegarder',
                'attr' => array('class' => 'btn btn-primary btn-md-2','style' => 'color:blue','margin-top:15px')])// ...
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}

?>