<?php

declare(strict_types=1);


namespace App\Repositories;

use App\DTO\GroupOfMessageDTO;
use App\Models\GroupOfMessages;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class GroupOfMessagesRepository implements GroupOfMessagesRepositoryInterface
{

    public function create(GroupOfMessageDTO $dto): GroupOfMessages
    {
        return GroupOfMessages::create($dto->toArray());
    }

    /**
     * @throw  ModelNotFoundException
     */
    public function update(int $id, GroupOfMessageDTO $dto): GroupOfMessages
    {
        $group = GroupOfMessages::findOrFail($id);
        $group->fill($dto->toArray());
        $group->save();

        return $group;
    }

    public function delete(int $id): void
    {
        GroupOfMessages::query()
            ->findOrFail($id)
            ->delete();
    }

    /**
     * @throw  ModelNotFoundException
     */
    public function find(int $id): GroupOfMessages
    {
        return GroupOfMessages::findOrFail($id);
    }

    public function getOrderedByLastMessageCreateTime(): Collection
    {
        return GroupOfMessages::query()
            ->select('group_of_messages.*', DB::raw('max(messages.created_at) as last_message_created_at'))
            ->leftJoin('messages', 'messages.group_id', 'group_of_messages.id')
            ->groupBy('group_of_messages.id')
            ->orderByDesc('last_message_created_at')
            ->get();
    }
}
