<?php

declare(strict_types=1);


namespace Modules\GroupOfMessages\Repositories;

use Illuminate\Support\Collection;
use Modules\Common\ValueObjects\SortDirection;

interface ReadGroupOfMessagesRepositoryContract
{
    public function find(int $id): ?object;

    public function findByName(string $name): ?object;

    public function getAll(SortDirection $direction = SortDirection::DESC): Collection;
}
