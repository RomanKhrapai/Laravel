<?php

namespace App\Http\Controllers\Api\Chat;

use App\Events\MessageSent;
use App\Events\StoreMessageEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Message\MessageRequest;
use App\Http\Resources\Chat\MessageResource;
use App\Http\Resources\ChatResource;
use App\Models\Chat;
use App\Repositories\Interfaces\ChatRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Broadcast;

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

        $chat = $message->chat;
        $userId =  Auth::user()->id !== $chat->user_id ? $chat->user_id : $chat->company->user_id;

        broadcast(new StoreMessageEvent($message, $userId))->toOthers();

        return new MessageResource($message);
    }
}
