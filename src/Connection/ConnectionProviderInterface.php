<?php

declare(strict_types=1);

namespace Yiisoft\Db\Connection;

use Yiisoft\Db\Connection\ConnectionInterface;

interface ConnectionProviderInterface
{
    public function get(string|int|null $name = null): ConnectionInterface;
}
