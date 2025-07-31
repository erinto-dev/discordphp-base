<?php

namespace App\Domain\External\Dotenv;

interface EnvManagerInterface
{
  public function getDiscordToken(): string;
  public function getMysqlInfo(): array;
  public function getProjectMode(): string;
}
