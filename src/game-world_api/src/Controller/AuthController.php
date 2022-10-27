<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/auth', name: 'auth_')]
class AuthController extends AbstractController
{
    #[Route('/login', name: 'login', methods: 'POST')]
    public function login(): Response
    {
        return new Response();
    }

    #[Route('/signin', name: 'signin', methods: 'POST')]
    public function signin(): Response
    {
        return new Response();
    }

    #[Route('/logout', name: 'logout', methods: 'POST')]
    public function logout(): Response
    {
        return new Response();
    }
}
