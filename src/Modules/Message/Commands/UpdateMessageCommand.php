<?php

declare(strict_types=1);


namespace Modules\Message\Commands;

use App\Bus\Command;

class UpdateMessageCommand extends Command
{
    public function __construct(
        private readonly int $id,
        private readonly string $text
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }
}
