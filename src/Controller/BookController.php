<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('book/index.html.twig', [
            'title' => 'Hello Marsupilami',
        ]);
    }

    /**
     * @Route("/user/edit", name="edit_profil")
     */
    public function editUserProfil() {}

    /**
     * @Route("/contact/add", name="add_contact")
     */
    public function addContact() {}

    /**
     * @Route("/contact/edit/{id}", name="edit_contact")
     */
    public function editContact() {}

    /**
     * @Route("/contact/delete", name="delete_contact")
     */
    public function deleteContact() {}
}
