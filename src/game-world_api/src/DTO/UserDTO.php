<?php

namespace App\DTO;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;
use App\Validator\{Username, Unique};
use App\Entity\User;

class UserDTO extends DTO
{
    public function __construct(
        #[
            NotBlank,
            Username,
            Unique(entityClass: User::class, columnName: 'username')
        ]
        public readonly ?string $username,
    ) {
    }

    static public function fromRequest(Request $request): DTO
    {
        $requestData = json_decode($request->getContent(), true);

        return new self(
            username: $requestData('username') ?? null,
        );
    }
}
