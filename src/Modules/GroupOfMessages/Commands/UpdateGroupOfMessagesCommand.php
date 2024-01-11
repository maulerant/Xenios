<?php

declare(strict_types=1);

namespace Modules\GroupOfMessages\Commands;

use App\Bus\Command;
use Modules\GroupOfMessages\ValueObjects\GroupName;

class UpdateGroupOfMessagesCommand extends Command
{
    public function __construct(
        private readonly int $id,
        private readonly GroupName $name
    ) {
    }

    public function getName(): GroupName
    {
        return $this->name;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
