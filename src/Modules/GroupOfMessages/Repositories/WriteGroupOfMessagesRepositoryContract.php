<?php

declare(strict_types=1);


namespace Modules\GroupOfMessages\Repositories;

use Modules\GroupOfMessages\ValueObjects\GroupName;

interface WriteGroupOfMessagesRepositoryContract
{
    public function create(GroupName $name): int;

    public function update(int $id, GroupName $name): int;

    public function delete(int $id): void;
}
