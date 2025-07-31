<?php

use App\Domain\External\Dotenv\EnvManagerInterface;
use App\Domain\Repository\ConnectionInterface;
use App\Infra\External\Dotenv\Manager\EnvManager;
use DI\Container;
use Discord\Discord;
use Bot\Commands\SlashCommands;
use Discord\Parts\Channel\Message;
use Discord\WebSockets\Event;
use Discord\WebSockets\Intents;

return function () {
  $container = new Container();
  (require_once("container/container_bootstrap.php"))($container);

  $discord = new Discord([
    "token" => $container->get(EnvManager::class)->getDiscordToken(),
    "intents" => Intents::getDefaultIntents() | Intents::GUILD_MESSAGES
  ]);



  $discord->on("init", function (Discord $discord) use($container) {
    echo "\n\n\n\n\n\n\n\n\n\n\n\n";
    echo "BOT INICIADO COM SUCESSO!";
    echo "\n\n\n\n\n\n\n\n\n\n\n\n";

    $slash = new SlashCommands($discord, $container);

    $discord->on(Event::MESSAGE_CREATE, function (Message $message) {
      if ($message->author->bot) return 0;
    });
  });

  $discord->run();
};
