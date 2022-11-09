<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\{Response, Request};
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Service\{AuthService, UserService};
use App\Repository\UserRepository;
use App\DTO\UserDTO;

#[Route('/users', name: 'users_')]
class UserController extends AppController
{
    public function __construct(
        private readonly AuthService $authService,
        private readonly UserService $userService,
        private readonly UserRepository $userRepository,
        private readonly ValidatorInterface $validator,
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

    #[Route('/me', name: 'update_me', methods: 'PUT')]
    public function updateMe(Request $request): Response
    {
        /** @var UserDTO $userDTO */
        $userDTO = UserDTO::fromRequest($request);

        $errors = $this->validator->validate($userDTO);
        if (count($errors) > 0) {
            return $this->jsonValidationErrors($errors);
        }

        $this->userService->updateActiveUser($userDTO);

        return new Response();
    }
}
