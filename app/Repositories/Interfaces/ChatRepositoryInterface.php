<?php

namespace App\Repositories\Interfaces;


interface ChatRepositoryInterface
{
    public function list($chat_id);
    public function chatsList();
    public function create($data);
    public function send($data, $chat);
}
