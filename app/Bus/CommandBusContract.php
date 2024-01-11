<?php

declare(strict_types=1);


namespace App\Bus;

interface CommandBusContract
{
    public function dispatch(Command $command): mixed;

    public function register(array $map): void;
}
