<?php

declare(strict_types=1);


namespace App\Repositories;

use App\DTO\MessageDTO;
use App\Models\Message;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface MessagesRepositoryInterface
{

    public function create(MessageDTO $dto): Model|Builder|Message;

    public function update(int $id, string $text): Model|Builder|Message;

    public function delete(int $id): void;
}
