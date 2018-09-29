<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * la fonction index affiche le profil du user ainsi que la liste de ses contacts
     */
    public function index(UserRepository $repo)
    {
        // On sélection le User logged in ?????
        $user = $this->getUser(); 

        // cherche la liste des contacts d'un user dans UserRepository
        $contacts = $user->getMyContacts(); 
                
        //$Mycontacts = $repo->findAll(); 

        return $this->render('book/index.html.twig', [
            'title' => 'Hello Marsupilami',
            'contacts' => $contacts, 
        ]);
    }

    /**
     * @Route("/contact/add", name="add_contact")
     */
    public function addContact(UserRepository $repo) 
    {
        // cherche la liste de tous les contacts dans UserRepository
        $contacts = $repo->findAll(); 

        return $this->render('book/add_contact.html.twig', [
            'title' => 'Hello Marsupilami',
            'contacts' => $contacts
        ]);
    }

    /**
     * @Route("/contact/delete", name="delete_contact")
     * la fonction delete contact doit supprimer la jointure
     */
    public function deleteContact() 
    {}
}
