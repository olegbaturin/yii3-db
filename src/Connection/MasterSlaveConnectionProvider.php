<?php

declare(strict_types=1);

namespace Yiisoft\Db\Connection;

use InvalidArgumentException;
use Yiisoft\Db\Connection\ConnectionInterface;

final class MasterSlaveConnectionProvider implements ConnectionProviderInterface
{
    public const MASTER = 'master';
    public const SLAVE = 'slave';

    private array $connections = [];
    private string $default = self::SLAVE;

    public function __construct(
        ConnectionInterface $master,
        ConnectionInterface ...$slaves,
    ) {
        $this->connections[self::MASTER] = [$master];
        $this->connections[self::SLAVE] = $slaves;
    }

    public function get(string|int|null $name = null): ConnectionInterface
    {
        $key ??= $this->default;

        return isset($this->connections[$key]) ? $this->connections[$key][array_rand($this->connections[$key])] :
                 throw new InvalidArgumentException("Connection with name `$name` does not exist.");
    }

    public function setDefault(string $name): void
    {
        if (!in_array($name, [self::MASTER, self::SLAVE], true)) {
            throw new InvalidArgumentException("Connection with name `$name` does not exist.");
        }

        $this->default = $name;
    }
}
