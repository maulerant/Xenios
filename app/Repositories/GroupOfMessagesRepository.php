<?php

declare(strict_types=1);


namespace App\Repositories;

use App\DTO\GroupOfMessageDTO;
use App\Models\GroupOfMessages;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class GroupOfMessagesRepository implements GroupOfMessagesRepositoryInterface
{

    public function create(GroupOfMessageDTO $dto): array|Collection|Model|GroupOfMessages|Builder
    {
        return GroupOfMessages::query()
            ->create($dto->toArray());
    }

    /**
     * @throw  ModelNotFoundException
     */
    public function update(int $id, GroupOfMessageDTO $dto): array|Collection|Model|GroupOfMessages|Builder
    {
        $group = GroupOfMessages::query()
            ->findOrFail($id);
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
    public function find(int $id): array|Collection|Model|GroupOfMessages|Builder
    {
        return GroupOfMessages::query()
            ->findOrFail($id);
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


    public function getWithMessages(int $groupId): array|Collection|Model|GroupOfMessages|Builder
    {
        return GroupOfMessages::query()
            ->with('messages')
            ->findOrFail($groupId);
    }
}
