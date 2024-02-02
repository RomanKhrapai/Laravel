<?php

namespace App\Repositories\Interfaces;


interface ChatRepositoryInterface
{

    public function list($user_id);
    public function send($data);
}
