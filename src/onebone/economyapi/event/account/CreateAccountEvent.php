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

namespace onebone\economyapi\event\account;

use onebone\economyapi\event\EconomyAPIEvent;
use onebone\economyapi\EconomyAPI;
use pocketmine\event\CancellableTrait;

class CreateAccountEvent extends EconomyAPIEvent{

    use CancellableTrait;

	public static $handlerList;

	/** @var string */
	private $username;

	/** @var float */
	private $defaultMoney;

	public function __construct(EconomyAPI $plugin, string $username, float $defaultMoney, string $issuer){
		parent::__construct($plugin, $issuer);
		$this->username = $username;
		$this->defaultMoney = $defaultMoney;
	}

	public function getUsername() : string{
		return $this->username;
	}

	public function setDefaultMoney(float $money) : void{
		$this->defaultMoney = $money;
	}

	public function getDefaultMoney() : float{
		return $this->defaultMoney;
	}
}
