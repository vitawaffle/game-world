<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use App\Entity\User;
use App\Service\AuthService;

#[Route('/auth', name: 'auth_')]
class AuthController extends AbstractController
{
    public function __construct(
        private readonly AuthService $authService,
    ) {
    }

    #[Route('/login', name: 'login', methods: 'POST')]
    public function login(#[CurrentUser] ?User $user): Response
    {
        if (null === $user) {
            return $this->json([
                'message' => 'Missing credentials.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $this->json([
            'user' => $user,
            'token' => $this->authService->login($user),
        ]);
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
