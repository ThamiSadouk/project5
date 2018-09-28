<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     * @Route("/user/edit/{id}", name="edit_profil")
     */
    public function registration(User $user = null, Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        if(!$user) {
            $user = new User();
        }

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request); 

        if($form->isSubmitted() && $form->isValid()) 
        {
            // if User doesn't exist, we set a new Datitme 
            if(!$user->getId()) {
                $user->setCreatedAt(new \DateTime()); 
            }

            $hash = $encoder->encodePassword($user, $user->getPassword()); 

            $user->setPassword($hash); 

            $manager->persist($user); 
            $manager->flush();

            return $this->redirectToRoute('home'); 
        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/connexion", name="security_login")
     */
    public function login() 
    {
       return $this->render('security/login.html.twig');  
    }

    /**
     * @Route("deconnexion", name="security_logout")
     */
    public function logout() {}
}
