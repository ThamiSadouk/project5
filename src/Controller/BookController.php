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
    public function index()
    {
        // On sélection le User logged in ?????
        $user = $this->getUser(); 

        // cherche la liste des contacts d'un user dans UserRepository
        $myContacts = $user->getMyContacts(); 
                
        return $this->render('book/index.html.twig', [
            'title' => $user->getUsername(),
            'contacts' => $myContacts, 
        ]);
    }

    /**
     * @Route("/members", name="member_directory")
     */
    public function memberDirectory(UserRepository $repo) 
    {
        // select all members
        $members = $repo->findAll(); 

        return $this->render('book/member_directory.html.twig', [
            'title' => 'Hello Marsupilami',
            'members' => $members
        ]);
    }

    /**
     * @Route("/add/contact/{id}", name="add_contact")
     */
    public function addContact($id, UserRepository $repo) 
    {
        // On sélectionne le User logged in ?????
        $user = $this->getUser(); 

        // On sélectionne le contact que l'on souhaite ajouter
        $contact = $repo->find($id); 

        if (!$contact) 
        {
            throw $this->createNotFoundException('Le contact n\'a pas été trouvé'); 
        }

        // on effectue la relation entre les 2 objects
        $user->addMyContact($contact); 

        return $this->redirectToRoute('member_directory'); 
    }


    
    // /**
    //  * @Route("/contact/remove/{id}", name="delete_contact")
    //  *  doit supprimer la jointure
    //  */
    // public function removeContact($id) 
    // {
    //     // on sélectionne notre user
    //     $user = $this->getUser(); 

    //     // si mes contacts existe alors on peut les supprimer 
    //     if($user->getMyContacts()) { 

    //         $manager = $this->getDoctrine()->getManager(); 

    //         $contact = $manager->getRepository(User::class)->find($id); 
    
    //         if(!$contact) 
    //         {
    //             throw $this->createNotFoundException('Le contact n\'a pas pu être supprimé'); 
    //         }
    //         $manager->removeMyContact($contact); 
    //         $manager->flush(); 
    //     }
    // }
}
