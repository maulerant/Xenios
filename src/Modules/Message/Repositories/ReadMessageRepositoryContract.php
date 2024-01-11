<?php

declare(strict_types=1);


namespace Modules\Message\Repositories;

use Illuminate\Support\Collection;
use Modules\Message\ValueObjects\GroupId;

interface ReadMessageRepositoryContract
{
    public function find(int $id): ?object;

    public function findByGroup(GroupId $groupId): Collection;

}
