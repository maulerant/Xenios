<?php

declare(strict_types=1);


namespace App\DTO;

class GroupOfMessageDTO
{
    use ToArray;

    public function __construct(
        public readonly string $name
    ) { }
}
