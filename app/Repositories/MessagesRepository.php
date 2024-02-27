<?php

declare(strict_types=1);


namespace App\Repositories;

use App\DTO\MessageDTO;
use App\Models\Message;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MessagesRepository implements MessagesRepositoryInterface
{

    public function create(MessageDTO $dto): Model|Builder|Message
    {
        return Message::query()
            ->create($dto->toArray());
    }

    public function update(int $id, string $text): Model|Builder|Message
    {
        /** @var Message $message */
        $message = Message::query()
            ->findOrFail($id);
        $message->text = $text;
        $message->save();

        return $message;
    }

    public function delete(int $id): void
    {
        Message::query()
            ->findOrFail($id)
            ->delete();
    }
}
