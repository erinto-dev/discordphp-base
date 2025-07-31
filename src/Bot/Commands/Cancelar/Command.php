<?php

namespace Bot\Commands\Cancelar;

use Discord\Parts\Interactions\Interaction;

class Command
{

    public string $name = "cancelar";
    public string $desc = "Comando usado para cancelar uma transação que foi iniciada, LEIA OS TERMOS";
    public function execute(Interaction $interaction): void
    {
        $interaction->respondWithMessage("teste");
    }
}