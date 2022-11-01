<?php

namespace App\DTO;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\{NotBlank, Email};
use App\Validator\{Password, Username, Unique};
use App\Entity\User;

class SigninDTO extends DTO
{
    private function __construct(
        #[
            NotBlank,
            Username,
            Unique(entityClass: User::class, columnName: 'username'),
        ]
        public readonly ?string $username,
        #[NotBlank, Password]
        public readonly ?string $password,
        #[
            NotBlank,
            Email,
            Unique(entityClass: User::class, columnName: 'email'),
        ]
        public readonly ?string $email,
    ) {
    }

    static public function fromRequest(Request $request): self
    {
        $requestData = json_decode($request->getContent(), true);

        return new self(
            username: $requestData['username'] ?? null,
            password: $requestData['password'] ?? null,
            email: $requestData['email'] ?? null,
        );
    }
}
