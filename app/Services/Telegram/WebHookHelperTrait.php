<?php

namespace App\Services\Telegram;

use Statickidz\GoogleTranslate;

trait WebHookHelperTrait
{
	public function translateMessage(string $message, string $textLang = 'ru', string $targetLang = 'en'): string
	{
		return (new GoogleTranslate())->translate($textLang, $targetLang, $message);
	}

}
