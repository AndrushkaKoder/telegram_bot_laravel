<?php

namespace App\Console\Commands\Telegram;

use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Console\Command;

class Bot extends Command
{

	protected $signature = 'bot:handle';
	protected $description = 'Command for register commands and other interactions with Telegram Bot';

	public function handle()
	{
		$bot = TelegraphBot::query()->first();
		/**
		 * @var $bot TelegraphBot
		 */
		$bot->registerCommands([
			'start' => 'Краткое инфо',
			'action' => 'Кнопка-счетчик'
		])->send();
	}
}
