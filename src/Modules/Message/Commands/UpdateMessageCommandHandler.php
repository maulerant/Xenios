<?php

declare(strict_types=1);


namespace Modules\Message\Commands;

use App\Bus\CommandHandler;
use Modules\Message\Repositories\WriteMessageRepositoryContract;

class UpdateMessageCommandHandler extends CommandHandler
{


    public function __construct(
        protected readonly WriteMessageRepositoryContract $repository
    ) {
    }

    public function handle(UpdateMessageCommand $command): int
    {
        return $this->repository->update(
            id: $command->getId(),
            text: $command->getText()
        );
    }
}
