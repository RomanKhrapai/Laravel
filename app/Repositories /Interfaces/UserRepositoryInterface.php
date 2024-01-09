<?php

namespace App\Repositories\Interfaces;

use App\Http\Filters\UserFilter;

interface UserRepositoryInterface
{
    public function register($data);
    // public function update($user, $data); 

}
