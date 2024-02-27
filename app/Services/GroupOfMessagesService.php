<?php

declare(strict_types=1);


namespace App\Services;

use App\DTO\GroupOfMessageDTO;
use App\Models\GroupOfMessages;
use App\Repositories\GroupOfMessagesRepositoryInterface;
use Illuminate\Support\Collection;

class GroupOfMessagesService
{
    public function __construct(
        protected readonly GroupOfMessagesRepositoryInterface $repository
    ) {
    }

    public function create(GroupOfMessageDTO $dto): GroupOfMessages
    {
        return $this->repository->create($dto);
    }

    public function update(int $id, GroupOfMessageDTO $dto): GroupOfMessages
    {
        return $this->repository->update($id, $dto);
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }

    public function find(int $id): GroupOfMessages
    {
        return $this->repository->find($id);
    }

    public function getOrderedByLastMessageCreateTime(): Collection
    {
        return $this->repository->getOrderedByLastMessageCreateTime();
    }
}
