<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FashionBundleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class,
                array('attr' => array('class' => 'form-control','style' => ''),'required'=>true))
            ->add('description', TextType::class,
                array('attr' => array('class' => 'form-control','style' => ''),'required'=>true))
            ->add('price', CurrencyType::class,
                array('attr' => array('class' => 'form-control','style' => ''),'required'=>true))
            ->add('fashionbordernumber', IntegerType::class,
                array('attr' => array('class' => 'form-control','style' => ''),'required'=>true))
            ->add('promotionstatus', RadioType::class,
                array('attr' => array('class' => 'form-control','style' => ''),'required'=>true))
            ->add('promotion', IntegerType::class,
                array('attr' => array('class' => 'form-control','style' => ''),'required'=>false))
            ->add('save', SubmitType::class, ['label' => 'Sauvegarder',
                'attr' => array('class' => 'btn btn-primary btn-md-2','style' => 'color:blue','margin-top:15px')])// ...
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => \App\Entity\Fashionbundle::class,
        ]);
    }
}
?>