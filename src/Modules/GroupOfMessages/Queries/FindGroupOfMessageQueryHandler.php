<?php

declare(strict_types=1);


namespace Modules\GroupOfMessages\Queries;

use App\Bus\QueryHandler;
use Modules\GroupOfMessages\Repositories\ReadGroupOfMessagesRepositoryContract;

class FindGroupOfMessageQueryHandler extends QueryHandler
{
    public function __construct(
        protected readonly ReadGroupOfMessagesRepositoryContract $repository
    ) {
    }

    public function handle(FindGroupOfMessagesQuery $query): ?object
    {
        return $this->repository->find($query->getId());
    }
}
