<?php

use App\Domain\External\Dotenv\DotEnvAdapterInterface;
use App\Domain\External\Dotenv\EnvManagerInterface;
use App\Domain\Repository\ConnectionInterface;
use App\Domain\Repository\UserRepositoryInterface;
use App\Infra\External\Dotenv\Adapter\DotEnvAdapter;
use App\Infra\External\Dotenv\Manager\EnvManager;
use App\Infra\Persistence\Database\Connection;
use App\Infra\Persistence\Mysql\UserRepository;
use DI\Container;
use Dotenv\Dotenv;

return function(Container $container): Container {
  $container->set(DotEnvAdapterInterface::class, fn() => new DotEnvAdapter(Dotenv::createImmutable(dirname(__DIR__, 2))));
  $container->set(EnvManagerInterface::class, fn(Container $c) => new EnvManager($c->get(DotEnvAdapterInterface::class)));
  $container->set(ConnectionInterface::class, fn(Container $c) => new Connection($c));
  $container->set(UserRepositoryInterface::class, fn(Container $c) => new UserRepository($c->get(ConnectionInterface::class)));

  return $container;
};
