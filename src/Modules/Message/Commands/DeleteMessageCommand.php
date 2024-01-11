<?php

declare(strict_types=1);


namespace Modules\Message\Commands;

use App\Bus\Command;

class DeleteMessageCommand extends Command
{
    public function __construct(
        private readonly int $id
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }


}
