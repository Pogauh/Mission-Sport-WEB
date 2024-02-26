<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Mailer\MailerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\ORM\EntityManagerInterface;

use App\Form\ModifAccountType;
use App\Form\AddProduitType;

use App\Entity\User;
use App\Entity\Produit;



class BaseController extends AbstractController
{
    #[Route('/base', name: 'app_base')]
    public function index(): Response
    {
        return $this->render('base/index.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }

    #[Route('/cgv', name: 'cgv')]
    public function cgv(): Response
    {
        return $this->render('base/cgv.html.twig', [
        ]);
    }

    #[Route('/mentionlegale', name: 'mentionlegale')]
    public function mentionlegale(): Response
    {
        return $this->render('base/mentionlegale.html.twig', [
        ]);
    }

    #[Route('/account', name: 'account')]
    public function account(): Response
    {
        return $this->render('base/compte.html.twig', [
        ]);
    }

    #[Route('/produit', name: 'produit')]
    public function produit(): Response
    {
        return $this->render('produit/produit.html.twig', [
        ]);
    }

    #[Route('/offre', name: 'offre')]
    public function offre(): Response
    {
        return $this->render('produit/offre.html.twig', [
        ]);
    }

    #[Route('/programme', name: 'programme')]
    public function programme(): Response
    {
        return $this->render('produit/programme.html.twig', [
        ]);
    }

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('contact/contact.html.twig', [
        ]);
    }

    #[Route('/panier', name: 'panier')]
    public function panier(): Response
    {
        return $this->render('base/panier.html.twig', [
        ]);
    }

    #[Route('modifAccount', name: 'modifAccount')]
    public function modifAccount(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
    $user = $this->getUser();

    $form = $this->createForm(ModifAccountType::class, $user);

    if ($request->isMethod('POST')) {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManagerInterface->flush();

            $this->addFlash('notice', 'Modifications effectuées');
            return $this->redirectToRoute('account');
        } else {
            $this->addFlash('notice', 'Modifications non effectuées');
        }
    }

    return $this->render('base/modifAccount.html.twig', [
        'form' => $form->createView(),
    ]);
}

}
