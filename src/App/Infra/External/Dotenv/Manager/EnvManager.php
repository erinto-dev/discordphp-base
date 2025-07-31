<?php
namespace App\Infra\External\Dotenv\Manager;

use App\Domain\External\Dotenv\DotEnvAdapterInterface;
use App\Domain\External\Dotenv\EnvManagerInterface;
use RuntimeException;

class EnvManager implements EnvManagerInterface
{

  public function __construct(private DotEnvAdapterInterface $dotEnvAdapterInterface)
  {
    
  }

  public function getDiscordToken(): string
  {
    if(!$this->dotEnvAdapterInterface->exists("DISCORD_TOKEN"))
      throw new RuntimeException("Crie e coloque o seu token no arquivo .env!");
    return $this->dotEnvAdapterInterface->get("DISCORD_TOKEN");
  }

  public function getMysqlInfo(): array
  {
    $mode = $this->getProjectMode();
    
    return [
      "host" => $this->dotEnvAdapterInterface->get("MYSQL_".$mode."_HOST"),
      "port" => $this->dotEnvAdapterInterface->get("MYSQL_".$mode."_PORT"),
      "user" => $this->dotEnvAdapterInterface->get("MYSQL_".$mode."_USER"),
      "pass" => $this->dotEnvAdapterInterface->get("MYSQL_".$mode."_PASS"),
      "db" => $this->dotEnvAdapterInterface->get("MYSQL_".$mode."_DATABASE")
    ];
  }

  public function getProjectMode(): string
  {
    return $this->dotEnvAdapterInterface->exists("MODE") ?  $this->dotEnvAdapterInterface->get("MODE") : "DEV";
  }
}
