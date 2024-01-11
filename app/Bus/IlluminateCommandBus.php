<?php

declare(strict_types=1);


namespace App\Bus;

use Illuminate\Bus\Dispatcher;

class IlluminateCommandBus implements CommandBusContract
{
    public function __construct(
        protected readonly Dispatcher $bus
    ) {
    }

    public function dispatch(Command $command): mixed
    {
        return $this->bus->dispatch($command);
    }

    public function register(array $map): void
    {
        $this->bus->map($map);
    }
}
