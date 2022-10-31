<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\AuthService;

#[Route('/users', name: 'users_')]
class UserController extends AbstractController
{
    public function __construct(
        private readonly AuthService $authService,
    ) {
    }

    #[Route('/me', name: 'get_me', methods: 'GET')]
    public function getMe(): Response
    {
        return $this->json($this->authService->getUser());
    }
}
