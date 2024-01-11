<?php

declare(strict_types=1);


namespace Modules\Message\ValueObjects;

use App\Models\GroupOfMessages;
use InvalidArgumentException;

class GroupId
{

    public function __construct(
        protected int $id
    ) {
        if (! GroupOfMessages::query()->where('id', $id)->exists()) {
            throw new InvalidArgumentException('Invalid group of messages id');
        }
    }

    public static function from(int $id): self
    {
        return new self($id);
    }

    public function getId(): int
    {
        return $this->id;
    }
}
