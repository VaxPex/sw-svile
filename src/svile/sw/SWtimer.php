<?php

/*
 *                _   _
 *  ___  __   __ (_) | |   ___
 * / __| \ \ / / | | | |  / _ \
 * \__ \  \ / /  | | | | |  __/
 * |___/   \_/   |_| |_|  \___|
 *
 * SkyWars plugin for PocketMine-MP & forks
 *
 * @Author: svile
 * @Kik: _svile_
 * @Telegram_Group: https://telegram.me/svile
 * @E-mail: thesville@gmail.com
 * @Github: https://github.com/svilex/SkyWars-PocketMine
 *
 * Copyright (C) 2016 svile
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
 *
 *
 * DONORS LIST :
 * - Ahmet
 * - Jinsong Liu
 * - no one
 *
 */

namespace svile\sw;

use pocketmine\scheduler\Task;

class SWtimer extends Task
{
	/** @var int */
	private $seconds = 0;
	/** @var bool */
	private $tick;
	/** @var SWmain */
	private $plugin;

	public function __construct(SWmain $plugin)
	{
		$this->plugin = $plugin;
		$this->tick = (bool)$plugin->config['sign.tick'];
	}

	public function onRun(): void
	{
		foreach ($this->plugin->arenas as $arenaName => $arena)
			$arena->tick();

		if ($this->tick) {
			if (($this->seconds % 5 == 0))
				$this->plugin->refreshSigns();
			$this->seconds++;
		}
	}
}