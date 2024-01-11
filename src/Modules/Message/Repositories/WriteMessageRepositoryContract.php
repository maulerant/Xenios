<?php

declare(strict_types=1);


namespace Modules\Message\Repositories;

use Modules\Message\ValueObjects\GroupId;

interface WriteMessageRepositoryContract
{
    public function create(GroupId $groupId, string $user, string $text,): int;

    public function update(int $id, string $text): int;

    public function delete(int $id): void;
}
