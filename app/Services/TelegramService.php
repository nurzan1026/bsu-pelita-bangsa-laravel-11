<?php

namespace App\Services;

use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramService
{
    public function sendNotification($message)
    {
        Telegram::sendMessage([
            'chat_id' => '1264723468', 
            'text' => $message,
        ]);
    }
}
