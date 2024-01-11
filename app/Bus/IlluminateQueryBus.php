<?php

declare(strict_types=1);


namespace App\Bus;

use Illuminate\Bus\Dispatcher;

class IlluminateQueryBus implements QueryBusContract
{

    public function __construct(
        protected readonly Dispatcher $bus
    ) {
    }

    public function ask(Query $query): mixed
    {
        return $this->bus->dispatch($query);
    }

    public function register(array $map): void
    {
        $this->bus->map($map);
    }
}
