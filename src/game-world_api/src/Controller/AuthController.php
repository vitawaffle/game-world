<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/auth', name: 'auth_')]
class AuthController extends AbstractController
{
    #[Route('/login', methods: 'POST', name: 'login')]
    public function login(): Response
    {
        return new Reponse();
    }

    #[Route('/signin', methods: 'POST', name: 'signin')]
    public function signin(): Response
    {
        return new Reponse();
    }

    #[Route('/logout', methods: 'POST', name: 'logout')]
    public function logout(): Response
    {
        return new Response();
    }
}
