<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\{Response, Request};
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Service\AuthService;
use App\DTO\SigninDTO;

#[Route('/auth', name: 'auth_')]
class AuthController extends AppController
{
    public function __construct(
        private readonly AuthService $authService,
        private readonly ValidatorInterface $validator,
    ) {
    }

    #[Route('/login', name: 'login', methods: 'POST')]
    public function login(): void
    {
    }

    #[Route('/signin', name: 'signin', methods: 'POST')]
    public function signin(Request $request): Response
    {
        $signinDTO = SigninDTO::fromRequest($request);

        $errors = $this->validator->validate($signinDTO);
        if (count($errors) > 0) {
            return $this->jsonValidationErrors($errors);
        }

        $this->authService->signin($signinDTO);

        return new Response();
    }
}
