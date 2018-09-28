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

    public function editUserProfil() {}

    public function addContact() {}

    public function editContact() {}

    public function deleteContact() {}
}
