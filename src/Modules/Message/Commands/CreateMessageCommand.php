<?php

declare(strict_types=1);


namespace Modules\Message\Commands;

use App\Bus\Command;
use Modules\Message\ValueObjects\GroupId;

class CreateMessageCommand extends Command
{
    public function __construct(
        private readonly GroupId $groupId,
        private readonly string $user,
        private readonly string $text
    ) {
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getGroupId(): GroupId
    {
        return $this->groupId;
    }

    public function getUser(): string
    {
        return $this->user;
    }


}
