<?php

declare(strict_types=1);

namespace Yiisoft\Db\Connection;

use InvalidArgumentException;
use Yiisoft\Db\Connection\ConnectionInterface;

final class PlainConnectionProvider implements ConnectionProviderInterface
{
    private array $connections = [];

    public function __construct(
        private string|int $default,
        array $keys,
        ConnectionInterface ...$connections,
    ) {
        // @TODO add arguments validation
        $this->connections = array_combine($keys, $connections);
    }

    public function get(string|int|null $name = null): ConnectionInterface
    {
        $key = $name ?? $this->default;

        return $this->connections[$key]
                ?? throw new InvalidArgumentException("Connection with name `$name` does not exist.");
    }
}
