<?php

namespace App\Domain\Repository;

interface UserRepositoryInterface
{
  public function getUserById(int $id): ?array;
  public function getUserByUsername(string $username): ?array;
  public function getUserByEmail(string $email): ?array;
  public function getUserByDiscordId(string $discord_id): ?array;
  public function createUser(string $email, string $senha, string $discord_id): bool;
  public function UpdateDiscordIdByEmail(string $email, string $discord_id): bool;
}
