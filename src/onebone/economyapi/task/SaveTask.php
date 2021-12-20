<?php

namespace onebone\economyapi\task;

use onebone\economyapi\EconomyAPI;
use pocketmine\scheduler\Task;

class SaveTask extends Task
{

    protected EconomyAPI $owner;

    public function __construct(EconomyAPI $owner)
    {
        $this->owner = $owner;
    }

    public function onRun(): void
    {
        $this->owner->saveAll();
    }
}
