<?php

declare(strict_types=1);

namespace Modules\GroupOfMessages\Commands;

use App\Bus\Command;

class DeleteGroupOfMessagesCommand extends Command
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
