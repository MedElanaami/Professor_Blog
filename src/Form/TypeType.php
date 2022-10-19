<?php

namespace App\Form;

use App\Entity\Blog;
use App\Entity\Cours;
use App\Entity\Semestre;
use App\Entity\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class TypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('nom')
        ->add('imageFile', VichFileType::class, [
        'required' => false,
        'allow_delete' => true,
        'delete_label' => 'supprimer',

        'asset_helper' => true,
    ]);;


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Type::class,
        ]);
    }
}
