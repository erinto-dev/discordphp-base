<?php

namespace App\Infra\Persistence\Mysql;

use App\Domain\Repository\ConnectionInterface;
use App\Domain\Repository\UserRepositoryInterface;
use PDO;

class UserRepository implements UserRepositoryInterface
{
  private PDO $conn;
  private string $table = "accounts";

  public function __construct(private ConnectionInterface $connectionInterface)
  {
    $this->conn = $connectionInterface->getConnection();
  }

  public function getUserById(int $id): ?array
  {
    $sql = "SELECT * FROM $this->table WHERE id = :id LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam("id", $id);
    $stmt->execute();
    $user = $stmt->fetch();
    return $user ? $user : null;
  }

  public function getUserByUsername(string $username): ?array
  {
    $sql = "SELECT * FROM $this->table WHERE name = :name LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam("name", $username);
    $stmt->execute();
    $user = $stmt->fetch();
    return is_array($user) ? $user : null;
  }

  public function getUserByEmail(string $email): ?array
  {
    $sql = "SELECT * FROM $this->table WHERE email = :email LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam("email", $email);
    $stmt->execute();
    $user = $stmt->fetch();
    return is_array($user) ? $user : null;
  }

  public function getUserByDiscordId(string $discord_id): ?array
  {
    $sql = "SELECT * FROM $this->table WHERE discord_id = :id LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam("id", $discord_id);
    $stmt->execute();
    $user = $stmt->fetch();
    return is_array($user) ? $user : null;
  }

  public function createUser(string $email, string $senha, $discord_id): bool
  {
    $sql = "INSERT INTO $this->table(email, password, discord_id) VALUES(:email, :password, :discord_id)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam("email", $email);
    $stmt->bindParam("password", $senha);
    $stmt->bindParam("discord_id", $discord_id);
    return $stmt->execute();
  }

  public function UpdateDiscordIdByEmail(string $email, string $discord_id): bool
  {
    $sql = "UPDATE FROM $this->table SET discord_id = :id WHERE email = :email";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam("id", $discord_id);
    $stmt->bindParam("email", $email);
    return (bool) $stmt->execute(); 
  }
}
