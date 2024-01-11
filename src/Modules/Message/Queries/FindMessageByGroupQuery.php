<?php

declare(strict_types=1);


namespace Modules\Message\Queries;

use App\Bus\Query;
use Modules\Message\ValueObjects\GroupId;

class FindMessageByGroupQuery extends Query
{
    public function __construct(
        protected GroupId $groupId
    ) {
    }

    public function getGroupId(): GroupId
    {
        return $this->groupId;
    }

}
