<?php

namespace App\DTO;

use Symfony\Component\HttpFoundation\Request;

abstract class DTO
{
    static abstract public function fromRequest(Request $request): self;
}
