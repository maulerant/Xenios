<?php

declare(strict_types=1);


namespace Modules\Message\Queries;

use App\Bus\Query;

class FindMessageQuery extends Query
{
    public function __construct(
        protected readonly int $id
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }
}
