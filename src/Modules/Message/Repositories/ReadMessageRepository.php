<?php

declare(strict_types=1);


namespace Modules\Message\Repositories;

use App\Models\Message;
use Illuminate\Support\Collection;
use Modules\Message\ValueObjects\GroupId;

class ReadMessageRepository implements ReadMessageRepositoryContract
{

    public function find(int $id): ?object
    {
        return Message::find($id);
    }

    public function findByGroup(GroupId $groupId): Collection
    {
        return Message::query()
            ->where('group_id', $groupId->getId())
            ->get();
    }
}
