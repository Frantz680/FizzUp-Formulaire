<?php

namespace App\Form;

use App\Entity\Avis;
use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AvisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $linkBack= $options['linkback'];

        $builder
            ->add('product', EntityType::class, array(
                'label' => 'Nom du produit',
                'class' => Product::class,
                'choice_label' => 'title',
                'mapped' => false
            ))

            ->add('pseudo')

            ->add('email')

            ->add('commentaire', CKEditorType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Commentaire',
                'config' => [
                    'language' => 'fr',
                    'toolbar' => 'standard'
                ]

            ])

            ->add('picture', FileType::class,[
                'label' => 'Image (Fichier image)',
                'mapped' => false,
                'required' => false,
            ])

            ->add('annuler', ButtonType::class, [
                'label' => 'Annuler',
                'attr' => [
                    'class' => 'btn btn-default btn-block',
                    'onclick' => 'location.href="'.$linkBack.'"'
                ],
            ])

            ->add('soumettre', SubmitType::class, [
                'label' => 'Soumettre',
                'attr' => ['class' => 'btn btn-primary btn-block'],
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'linkback' => null,
        ]);
    }
}

