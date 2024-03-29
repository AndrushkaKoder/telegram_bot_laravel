<?php

namespace App\Services\Telegram;

use App\Models\Counter;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use Illuminate\Support\Stringable;

class BotHandler extends WebhookHandler
{
	use WebHookHelperTrait;


	public function handleChatMessage(Stringable $text): void
	{
		$id = $this->message->from()->id();
		$chat = $this->chat->chat_id;

		Telegraph::chat($chat)->message("*Your telegram id:* {$id}; \n *Message:* " . $this->translateMessage($text))
			->keyboard(Keyboard::make()->buttons([
				Button::make('Добавить клик')->action('click'),
			])
			)->send();
	}


	public function click(): void
	{
		$counter = Counter::query()
			->firstOrCreate([
				'bot_id' => $this->bot->id
			]);

		$newCount = $counter->count + 1;
		$counter->update([
			'count' => $newCount
		]);

		$chat = $this->chat->chat_id;
		Telegraph::chat($chat)->message("Счетчик кликов: {$newCount}")->send();
	}

}
