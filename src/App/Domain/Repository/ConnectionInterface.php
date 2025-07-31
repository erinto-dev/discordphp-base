<?php

namespace App\Domain\Repository;

use PDO;

interface ConnectionInterface
{
  public function getConnection(): PDO;
  public function getConnectionOptions(): array;
}
