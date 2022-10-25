<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/users', name: 'users_')]
class UserController extends AbstractController
{
    #[Route('/me', methods: 'GET', name: 'get_me')]
    public function getMe(): Response
    {
        return new Response();
    }
}
