<?php

namespace App\Repositories;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\QueryException;
use App\Repositories\Interfaces\ChatRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatRepository implements ChatRepositoryInterface
{
    public function chatsList()
    {
        $user = Auth::user();
        if ($user->role_id === 3) {
            return User::find($user->id)->chats()
                ->with(['lastMessage' => function ($query) {
                    $query->select('id', 'chat_id', 'read', 'created_at')
                        ->latest()
                        ->first();
                }])
                ->get();
        }

        return User::find($user->id)->companiesChats()
            ->with(['lastMessage' => function ($query) {
                $query->select('id', 'chat_id', 'read', 'created_at')
                    ->latest()
                    ->first();
            }])
            ->get();
    }


    public function create($data)
    {
        try {
            if (empty($data['user_id'])) {
                $data['user_id'] = Auth::user()->id;
            }

            $chat = new Chat();
            $chat->fill($data)->save();

            return $chat;
        } catch (QueryException $e) {
            // Обробка помилки бази даних
            if ($e->errorInfo[1] == 1062) {
                $existingChat = Chat::where('company_id', $data['company_id'])
                    ->where('user_id', $data['user_id'])
                    ->first();

                return $existingChat;
            }
            return null;
        }
    }

    public function list($chat_id)
    {
        return  Message::where('chat_id', $chat_id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function send($data, $chat)
    {
        $data['sender_id'] = Auth::user()->id;
        $data['chat_id'] = $chat->id;
        $data['read'] = true;

        $message = new Message;
        $message->fill($data)->save();

        return $message;
    }
}
