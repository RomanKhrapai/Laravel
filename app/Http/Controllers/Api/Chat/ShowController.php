<?php

namespace App\Http\Controllers\Api\Chat;

use App\Http\Controllers\Controller;
use App\Http\Resources\Chat\MessageResource;
use App\Models\Chat;
use App\Repositories\Interfaces\ChatRepositoryInterface;


class ShowController extends Controller
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

    public function __invoke(Chat $chat)
    {
        $messages = $this->repository->list($chat->id);
        return MessageResource::collection($messages);
    }
}
