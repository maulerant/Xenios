<?php

declare(strict_types=1);

namespace Modules\GroupOfMessages\Commands;

use App\Bus\Command;
use Modules\GroupOfMessages\ValueObjects\GroupName;

class CreateGroupOfMessagesCommand extends Command
{
    public function __construct(
        private readonly GroupName $name
    ) {
    }

    public function getName(): GroupName
    {
        return $this->name;
    }
}
