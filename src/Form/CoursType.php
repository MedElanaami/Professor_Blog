<?php

namespace App\Form;

use App\Entity\Blog;
use App\Entity\Cours;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('url')
            ->add('auteur')
            ->add('type')
            ->add('semestre')
            ->add('description',CKEditorType::class)
            ->add('pdfFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'supprimer',
                'asset_helper' => true,
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}
