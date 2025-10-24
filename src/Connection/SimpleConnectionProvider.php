<?php

declare(strict_types=1);

namespace Yiisoft\Db\Connection;

use Yiisoft\Db\Connection\ConnectionInterface;

final readonly class SimpleConnectionProvider implements ConnectionProviderInterface
{
    public function __construct(
        private ConnectionInterface $connection,
    ) {}

    public function get(string|int|null $name = null): ConnectionInterface
    {
        return $this->connection;
    }
}
