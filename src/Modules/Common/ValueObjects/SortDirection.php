<?php

declare(strict_types=1);


namespace Modules\Common\ValueObjects;

enum SortDirection: string
{
    case ASC = 'ASC';
    case DESC = 'DESC';
}
