<?php

/*
 * EconomyS, the massive economy plugin with many features for PocketMine-MP
 * Copyright (C) 2013-2016  onebone <jyc00410@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace onebone\economyapi\command;

use onebone\economyapi\EconomyAPI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class SeeMoneyCommand extends Command
{
    private EconomyAPI $plugin;

    public function __construct(EconomyAPI $plugin)
    {
        parent::__construct('돈보기', '다른 플레이어의 돈을 확인합니다.', '/돈보기 [플레이어]', ['돈확인', 'seemoney']);
        $this->setPermission('eco.true');

        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void
    {
        $player = array_shift($args);

        if (trim($player) === "") {
            $sender->sendMessage(EconomyAPI::$prefix . "사용법 : " . $this->getUsage());
            return;
        }

        if (($p = $this->plugin->getServer()->getPlayerByPrefix($player)) instanceof Player) {
            $player = $p->getName();
        }

        if (!$this->plugin->accountExists($player)) {
            $sender->sendMessage(EconomyAPI::$prefix . $player . " 님은 서버에 접속한 적이 없습니다.");
            return;
        }
        $total = count($this->plugin->getAllMoney());
        $sender->sendMessage(EconomyAPI::$prefix . $player . "님의 돈 : " . $this->plugin->koreanWonFormat($this->plugin->myMoney($player)));
        $sender->sendMessage(EconomyAPI::$prefix . $player . "님의 순위 : 전체 " . number_format($total) . "명중 " . number_format($this->plugin->getRank($player)) . "위");
    }
}
