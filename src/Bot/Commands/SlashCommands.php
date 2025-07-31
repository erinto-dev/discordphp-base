<?php

namespace Bot\Commands;

use Discord\Discord;
use Discord\Parts\Interactions\Command\Command;
use LogicException;
use Psr\Container\ContainerInterface;

class SlashCommands
{


  public function __construct(Discord $discord, ContainerInterface $containerInterface)
  {
    $commandFile = glob(__DIR__ . "/*/Command.php");

    foreach ($commandFile as $file) {
      if (!is_file($file))
        return;

      require_once $file;
      $folder = basename(dirname($file));
      $className = "Bot\\Commands\\$folder\\Command";

      if (class_exists($className)) {

        $instance = new $className($containerInterface);

        if (!isset($instance->name) || !isset($instance->desc))
          throw new LogicException("Declare as propriedades em $className");

        $commandArray = [
          "name" => $instance->name,
          "description" => $instance->desc
        ];

        if (isset($instance->options) && is_array($instance->options)) {
          $commandArray += ["options" => $instance->options];
        }

        $command = new Command($discord, $commandArray);
        $discord->listenCommand($instance->name, [$instance, 'execute']);
        $discord->application->commands->save($command);
        echo "\n\n\nComandos enviado ao discord\n\n\n";
      }
    }
  }
}

