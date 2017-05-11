<?php

namespace MusicBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlbumType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['label' => 'Nom de l\'album'])
            ->add('picture', UrlType::class, ['label' => 'URL de l\'image'])
            ->add('artist', EntityType::class, [
                "label" => "Artiste",
                "class" => "MusicBundle:Artist",
                "choice_label" => "name"
            ])
            ->add('tags', EntityType::class, [
                "label" => "Étiquettes",
                "class" => "MusicBundle:Tag",
                "choice_label" => "name",
                "multiple" => true,
                "expanded" => false,
            ])
            ->add('submit', SubmitType::class, ['label' => 'Enregistrer']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MusicBundle\Entity\Album'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'musicbundle_album';
    }


}
