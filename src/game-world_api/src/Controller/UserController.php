<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Response, Request};
use Symfony\Component\Routing\Annotation\Route;
use App\Service\AuthService;
use App\Repository\UserRepository;

#[Route('/users', name: 'users_')]
class UserController extends AbstractController
{
    public function __construct(
        private readonly AuthService $authService,
        private readonly UserRepository $userRepository,
    ) {
    }

    #[Route('/me', name: 'get_me', methods: 'GET')]
    public function getMe(): Response
    {
        return $this->json($this->authService->getUser());
    }

    #[Route('/exists', name: 'exists', methods: 'GET')]
    public function existsBy(Request $request): Response
    {
        return $this->json(
            $this->userRepository->findOneBy($request->query->all()) !== null
        );
    }
}
