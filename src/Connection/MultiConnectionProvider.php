<?php

declare(strict_types=1);

namespace Yiisoft\Db\Connection;

use InvalidArgumentException;
use Yiisoft\Db\Connection\ConnectionInterface;

final class MultiConnectionProvider implements ConnectionProviderInterface
{
    private array $connections = [];

    public function __construct(
        ConnectionInterface $connection,
        private int $number,
    ) {
        for ($i = 0; $i < $this->number; $i++) {
            $this->connections[] = clone $connection;
        }
    }

    public function get(string|int|null $name = null): ConnectionInterface
    {
        $key = $name ?? rand(0, $this->number-1);

        return $this->connections[$key]
                ?? throw new InvalidArgumentException("Connection with name `$name` does not exist.");
    }
}
