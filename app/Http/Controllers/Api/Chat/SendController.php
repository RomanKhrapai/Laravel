<?php

namespace App\Http\Controllers\Api\Chat;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Message\MessageRequest;
use App\Http\Resources\ChatResource;
use App\Repositories\Interfaces\ChatRepositoryInterface;

class ChatController extends Controller
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

    public function __invoke(MessageRequest $request)
    {
        $message = $this->repository->send($request->validated());
        //репозиторій виклик, який повертає модель повідомлення
        broadcast(new MessageSent($message));
        // повертаю ресурс
        return new ChatResource($message);
    }
}
