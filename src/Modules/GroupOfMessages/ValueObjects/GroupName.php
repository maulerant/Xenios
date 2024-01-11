<?php

declare(strict_types=1);


namespace Modules\GroupOfMessages\ValueObjects;


use InvalidArgumentException;

class GroupName
{
    public function __construct(
        protected string $name
    ) {
        if (empty($name)) {
            throw new InvalidArgumentException('Invalid group of messages name');
        }
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public static function from(string $name): self
    {
        return new self($name);
    }
}
