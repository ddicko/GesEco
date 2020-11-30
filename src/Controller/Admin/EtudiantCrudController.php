<?php

namespace App\Controller\Admin;

use App\Entity\Etudiant;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EtudiantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Etudiant::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
    public function configureFields(string $pageName): iterable
    {
        return [
            
            IdField::new('id')->onlyOnDetail(),
            TextField::new('matricule'),
            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('sexe'),
            TextField::new('adresse'),
            
            DateTimeField::new('date_naissance')->hideOnIndex(),
            TextField::new('filename')->hideOnIndex(),
            DateTimeField::new('updated_at')->hideOnIndex(),
            IntegerField::new('contactparent'),
            
            TextField::new('nompere')->hideOnIndex(),
            TextField::new('nommere')->hideOnIndex(),
            TextField::new('autres'),
            AssociationField::new('libelle')
        ];
    }
 
    public function configureActions(Actions $actions): Actions
    {

        $detail= Action::new('detail','Detail','fa fa-user-graduate')
            ->linkToCrudAction(Crud::PAGE_DETAIL)
            ->addCssClass('btn btn-info');

        return $actions
        ->add(Crud::PAGE_INDEX,$detail);
    }
}
