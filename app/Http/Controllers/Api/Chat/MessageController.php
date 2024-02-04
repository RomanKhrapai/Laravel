<?php

namespace App\Http\Controllers\Api\Chat;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChatResource;
use App\Repositories\Interfaces\ChatRepositoryInterface;


class MessageController extends Controller
{
    /**
     * @var repository
     */
    private $repository;

    /**
     * UserController constructor.
     *
     * @param repository $repository
     */
    public function __construct(ChatRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($user_id)
    {
        $messages = $this->repository->list($user_id);
        return ChatResource::collection($messages);
    }
}
