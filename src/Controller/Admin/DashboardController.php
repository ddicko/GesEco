<?php

namespace App\Controller\Admin;

use App\Entity\Classes;
use App\Entity\Matiere;
use App\Entity\Etudiant;
use App\Entity\Enseignant;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('SchoolManager');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        
        yield    MenuItem::linkToCrud('Etudiants', 'fas fa-user-graduate', Etudiant::class);
        yield    MenuItem::linkToCrud('Classes', 'fas fa-school', Classes::class);
        yield    MenuItem::linkToCrud('Enseignants', 'fas fa-chalkboard-teacher', Enseignant::class);
        yield    MenuItem::linkToCrud('Matiere', 'fa fa-file-text', Matiere::class);
        
    }

    
}


