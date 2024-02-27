<?php

declare(strict_types=1);


namespace App\Repositories;

use App\DTO\GroupOfMessageDTO;
use App\Models\GroupOfMessages;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface GroupOfMessagesRepositoryInterface
{
    public function create(GroupOfMessageDTO $dto): Builder|array|Collection|Model|GroupOfMessages;

    public function update(int $id, GroupOfMessageDTO $dto):  Builder|array|Collection|Model|GroupOfMessages;

    public function delete(int $id): void;

    public function find(int $id): Builder|array|Collection|Model|GroupOfMessages;

    public function getOrderedByLastMessageCreateTime(): Collection;

    public function getWithMessages(int $groupId): Builder|array|Collection|Model|GroupOfMessages;
}
