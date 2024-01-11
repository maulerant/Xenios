<?php

declare(strict_types=1);


namespace Modules\Message\Commands;

use App\Bus\CommandHandler;
use Modules\Message\Repositories\WriteMessageRepositoryContract;

class CreateMessageCommandHandler extends CommandHandler
{

    public function __construct(
        protected readonly WriteMessageRepositoryContract $repository
    ) {
    }

    public function handle(CreateMessageCommand $command): int
    {
        return $this->repository->create(
            groupId: $command->getGroupId(),
            user: $command->getUser(),
            text: $command->getText()
        );
    }
}
