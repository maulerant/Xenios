<?php

declare(strict_types=1);


namespace App\Services;

use App\DTO\MessageDTO;
use App\Models\Message;
use App\Repositories\MessagesRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MessagesService
{
public function __construct(
    protected readonly MessagesRepositoryInterface $repository
) { }

    public function create(MessageDTO $dto):Model|Builder|Message
    {
        return $this->repository->create($dto);
    }

    public function update(int $id, string $text): Model|Builder|Message
    {
        return $this->repository->update($id, $text);
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }
}
