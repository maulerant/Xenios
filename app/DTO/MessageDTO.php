<?php

declare(strict_types=1);


namespace App\DTO;

class MessageDTO
{
    use ToArray;
    public function __construct(
        public readonly string $user,
        public readonly int $group_id,
        public readonly string $text,
    )
    {
    }
}
