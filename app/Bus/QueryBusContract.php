<?php

declare(strict_types=1);


namespace App\Bus;

interface QueryBusContract
{
    public function ask(Query $query): mixed;

    public function register(array $map): void;
}
