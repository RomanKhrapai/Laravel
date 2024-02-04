<?php

namespace App\Http\Controllers\Api\Chat;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Message\MessageRequest;
use App\Http\Resources\Chat\MessageResource;
use App\Http\Resources\ChatResource;
use App\Models\Chat;
use App\Repositories\Interfaces\ChatRepositoryInterface;

class SendController extends Controller
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

    public function __invoke(MessageRequest $request, Chat $chat)
    {
        $message = $this->repository->send($request->validated(), $chat);

        // broadcast(new MessageSent($message));

        return new MessageResource($message);
    }
}
