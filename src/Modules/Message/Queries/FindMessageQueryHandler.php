<?php

declare(strict_types=1);


namespace Modules\Message\Queries;

use App\Bus\QueryHandler;
use Modules\Message\Repositories\ReadMessageRepositoryContract;

class FindMessageQueryHandler extends QueryHandler
{
    public function __construct(
        protected readonly ReadMessageRepositoryContract $repository
    ) {
    }

    public function handle(FindMessageQuery $query): ?object
    {
        return $this->repository->find($query->getId());
    }
}
