<?php

namespace App\Form;

use App\Entity\Etudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matricule')
            ->add('nom')
            ->add('prenom')
            ->add('date_naissance', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
            ])
            ->add('sexe', ChoiceType::class, [
                'choices'  => [
                    'M' => false,
                    'F' => true,
                    
                ],
            ])
            ->add('imageFile', FileType::class,[
                'required'=> false
            ])
            ->add('adresse')
            ->add('contactparent')
            ->add('nompere')
            ->add('nommere')
            ->add('classe', ChoiceType::class, [
                'choices'  => [
                    'L1-Réseaux&Telecom' => false,
                    'L2-Réseaux&Telecom' => true,
                    'L3-Réseaux&Telecom' => false,
                    'L1-Génie Logiciel' => false,
                    'L1-Génie Logiciel' => false,
                    'L2-Génie Logiciel' => false,
                    'L3-Génie Logiciel' => false,

                ],
            ])
            ->add('autres')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
