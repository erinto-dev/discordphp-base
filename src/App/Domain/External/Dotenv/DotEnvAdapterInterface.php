<?php

namespace App\Domain\External\Dotenv;

interface DotEnvAdapterInterface
{
  public function get(string $key): ?string;
  public function exists(string $key): bool;
  public function all(): ?array;
}
