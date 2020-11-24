<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Repository\EtudiantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class EtudiantController extends AbstractController
{
    /** 
     * @var EtudiantRepository
    */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EtudiantRepository $repository, EntityManagerInterface $em){
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/etudiant", name="etudiant.list")
     */
    public function indexEtudiant(PaginatorInterface $paginator, Request $request): Response
    {
        $etudiants = $paginator->paginate(
            $this->repository->findAll(),
            $request->query->getInt('page',1),4
        );
        return $this->render('Etudiant/indexEtudiant.html.twig', compact('etudiants'));

    }

    /**
     * @Route("/admin/etudiant/create", name="etudiant.create")
     */
    public function createEtudiant(Request $request)
    {
        $etudiants = new Etudiant();
        $form=$this->createForm(EtudiantType::class,$etudiants);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($etudiants);
            $this->em->flush();
            $this->addFlash(
                '	success',
                '	Etudiant Crée avec succès'
                );
            return $this->redirectToRoute('etudiant.list');
        }
        return $this->render('Etudiant/newEtudiant.html.twig', [
            'etudiants' => $etudiants,
            'form' => $form->createView()
        ]);

    }
     

    /**
     * @Route("/admin/etudiant/{id}", name="etudiant.edit", methods="GET|POST")
     */
    public function editEtudiant(Etudiant $etudiants, Request $request)
    {
        $form=$this->createForm(EtudiantType::class,$etudiants);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->em->flush();
            $this->addFlash(
            '	success',
            '	Etudiant Modifié avec succès'
            );
            return $this->redirectToRoute('etudiant.list');
        }

        return $this->render('Etudiant/editEtudiant.html.twig', [
            'etudiants' => $etudiants,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/admin/etudiant/{id}", name="etudiant.del", methods="DELETE")
     * @param Etudiant $etudiants
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delEtudiant(Etudiant $etudiants)
    {
        $this->em->remove($etudiants);
        $this->em->flush();
        $this->addFlash(
            '	success',
            '	Etudiant Supprimé avec succès'
            );
        
        return $this->redirectToRoute('etudiant.list');

    }
}