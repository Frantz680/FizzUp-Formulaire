<?php

namespace App\Form;

use App\Entity\Avis;
use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

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
                'required' => true
            ))

            ->add('note', IntegerType::class, [
                'constraints' => new Type(['type' => 'numeric']),
                'label' => 'Noté le produit de 0 à 9',
                'data' => 0, // default value
                'required' => true,
                'constraints' => array(
                    new NotBlank(), 
                    new Type('integer'), 
                    new Regex(array(
                        'pattern' => '/^[0-9]\d*$/',
                        'message' => "Veuillez n'utiliser que des nombres positifs."
                        )
                    ),
                    new Length(array(
                        'max' => 1,
                        'maxMessage' => "Vous devez avoir moins de {{ limit }} caracteres.",
                    ))
                )
            ])

            ->add('pseudo', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez écrire votre prénom où pseudo',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => "Vous devez avoir au moins {{ limit }} caracteres ou plus.",
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'label' => 'Prénom',
            ])

            ->add('email', EmailType::class, [
                'invalid_message' => "L'email n'est pas valide.",
                'attr' => ['class' => 'form-control'],
                'required' => false
            ])

            ->add('commentaire', CKEditorType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Commentaire',
                'config' => [
                    'language' => 'fr',
                    'toolbar' => 'standard'
                ],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez écrire un commentaire.',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => "Vous devez avoir au moins {{ limit }} caracteres ou plus.",
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])

            ->add('picture', FileType::class,[
                'label' => 'Image (Fichier image)',
                'mapped' => false,
                'required' => false
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

