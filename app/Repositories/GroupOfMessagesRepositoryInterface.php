<?php

declare(strict_types=1);


namespace App\Repositories;

use App\DTO\GroupOfMessageDTO;
use App\Models\GroupOfMessages;
use Illuminate\Support\Collection;

interface GroupOfMessagesRepositoryInterface
{
    public function create(GroupOfMessageDTO $dto): GroupOfMessages;

    public function update(int $id, GroupOfMessageDTO $dto): GroupOfMessages;

    public function delete(int $id): void;

    public function find(int $id):GroupOfMessages;

    public function getOrderedByLastMessageCreateTime(): Collection;
}
