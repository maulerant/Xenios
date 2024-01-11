<?php

declare(strict_types=1);


namespace Modules\Message\Commands;

use Modules\Message\Repositories\WriteMessageRepositoryContract;

class DeleteMessageCommandHandler
{
    public function __construct(
        protected readonly WriteMessageRepositoryContract $repository
    ) {
    }

    public function handle(DeleteMessageCommand $command): void
    {
        $this->repository->delete(
            $command->getId()
        );
    }
}
