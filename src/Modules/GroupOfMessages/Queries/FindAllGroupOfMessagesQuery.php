<?php

declare(strict_types=1);


namespace Modules\GroupOfMessages\Queries;

use App\Bus\Query;
use Modules\Common\ValueObjects\SortDirection;

class FindAllGroupOfMessagesQuery extends Query
{
    public function __construct(
        protected SortDirection $sort = SortDirection::DESC
    ) {
    }

    public function getSort(): SortDirection
    {
        return $this->sort;
    }
}
