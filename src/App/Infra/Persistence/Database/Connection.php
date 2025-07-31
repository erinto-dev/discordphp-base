<?php

namespace App\Infra\Persistence\Database;

use App\Domain\External\Dotenv\EnvManagerInterface;
use App\Domain\Repository\ConnectionInterface;
use App\Infra\External\Dotenv\Manager\EnvManager;
use PDO;
use Psr\Container\ContainerInterface;

class Connection implements ConnectionInterface
{
  public function __construct(private ContainerInterface $containerInterface)
  {
    
  }

  public function getConnection(): PDO { 
    $sql = $this->containerInterface->get(envManagerInterface::class)->getMysqlInfo();
    return new PDO("mysql:host=".$sql["host"].":".$sql["port"].";dbname=".$sql["db"], $sql["user"], $sql["pass"], $this->getConnectionOptions());
  }

  public function getConnectionOptions(): array
  {
    return [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
  }
}
