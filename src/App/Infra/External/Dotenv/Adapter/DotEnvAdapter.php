<?php

namespace App\Infra\External\Dotenv\Adapter;

use App\Domain\External\Dotenv\DotEnvAdapterInterface;
use Dotenv\Dotenv;

class DotEnvAdapter implements DotEnvAdapterInterface
{

  private array $env;
  public function __construct(private Dotenv $dotenv)
  {
    $this->env = $dotenv->load();
  }

  public function get(string $key): ?string
  {
    return $this->env[$key] ?? null;
  }

  public function exists(string $key): bool
  {
    return array_key_exists($key, $this->env);
  }

  public function all(): ?array
  {
    return $this->env;
  }
}
