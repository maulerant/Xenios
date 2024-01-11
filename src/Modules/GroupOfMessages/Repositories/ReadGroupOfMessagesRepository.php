<?php

declare(strict_types=1);


namespace Modules\GroupOfMessages\Repositories;

use App\Models\GroupOfMessages;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Common\ValueObjects\SortDirection;

class ReadGroupOfMessagesRepository implements ReadGroupOfMessagesRepositoryContract
{

    public function find(int $id): ?object
    {
        return GroupOfMessages::find($id);
    }

    public function findByName(string $name): ?object
    {
        return GroupOfMessages::query()
            ->where('name', $name)
            ->first();
    }

    public function getAll(SortDirection $direction = SortDirection::DESC): Collection
    {
        return GroupOfMessages::query()
            ->select('group_of_messages.*', DB::raw('max(messages.created_at) as last_message_created_at'))
            ->leftJoin('messages', 'messages.group_id', 'group_of_messages.id')
            ->groupBy('group_of_messages.id')
            ->orderByDesc('last_message_created_at')
            ->get();
    }
}
