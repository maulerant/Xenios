<?php

declare(strict_types=1);


namespace Modules\Message\Repositories;

use App\Models\Message;
use Modules\Message\ValueObjects\GroupId;

class WriteMessageRepository implements WriteMessageRepositoryContract
{

    public function create(GroupId $groupId, string $user, string $text): int
    {
        return Message::query()
            ->create([
                'group_id' => $groupId->getId(),
                'user' => $user,
                'text' => $text
            ])->getKey();
    }

    public function update(int $id, string $text): int
    {
        $group = Message::findOrFail($id);
        $group->text = $text;
        $group->save();

        return $id;
    }

    public function delete(int $id): void
    {
        Message::findOrFail($id)
            ->delete();
    }
}
