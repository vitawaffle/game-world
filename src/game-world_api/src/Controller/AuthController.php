<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\{Response, Request};
use App\Service\AuthService;

#[Route('/auth', name: 'auth_')]
class AuthController extends AbstractController
{
    public function __construct(
        private readonly AuthService $authService,
    ) {
    }

    #[Route('/login', name: 'login', methods: 'POST')]
    public function login(): void
    {
    }

    #[Route('/signin', name: 'signin', methods: 'POST')]
    public function signin(Request $request): Response
    {
        $requestData = json_decode($request->getContent(), true);

        $this->authService->signin(
            $requestData['username'],
            $requestData['password'],
        );

        return new Response();
    }
}
