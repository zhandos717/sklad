<?php

namespace App\Services\Telegram;

use DefStudio\Telegraph\Handlers\WebhookHandler;

class WebhookHandlerService extends WebhookHandler
{

    public function start()
    {
        $this->chat->html("Chat ID: {$this->chat->chat_id}")->send();
    }

}
