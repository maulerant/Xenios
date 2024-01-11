<?php

declare(strict_types=1);


namespace Modules\GroupOfMessages\Repositories;

use App\Models\GroupOfMessages;
use Modules\GroupOfMessages\ValueObjects\GroupName;

class WriteGroupOfMessagesRepository implements WriteGroupOfMessagesRepositoryContract
{

    public function create(GroupName $name): int
    {
        return GroupOfMessages::query()
            ->create([
                'name' => $name
            ])->getKey();
    }

    public function update(int $id, GroupName $name): int
    {
        $group = GroupOfMessages::findOrFail($id);
        $group->name = (string) $name;
        $group->save();

        return $id;
    }

    public function delete(int $id): void
    {
        GroupOfMessages::findOrFail($id)
            ->delete();
    }
}
