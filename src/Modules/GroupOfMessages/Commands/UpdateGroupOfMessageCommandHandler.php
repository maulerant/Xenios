<?php

declare(strict_types=1);


namespace Modules\GroupOfMessages\Commands;

use App\Bus\CommandHandler;
use Modules\GroupOfMessages\Repositories\WriteGroupOfMessagesRepositoryContract;
use Modules\GroupOfMessages\Repositories\WriteMessageRepositoryContract;

class UpdateGroupOfMessageCommandHandler extends CommandHandler
{
    public function __construct(
        protected readonly WriteGroupOfMessagesRepositoryContract $repository
    ) {
    }

    public function handle(UpdateGroupOfMessagesCommand $command): int
    {
        return $this->repository->update($command->getId(), $command->getName());
    }
}
