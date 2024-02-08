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
            $userChats = User::find($user->id)->chats;

            foreach ($userChats as $chat) {
                $chat->load(['messages' => function ($query) {
                    $query->latest()->first();
                }]);
            }
            return $userChats;
        }

        $userChats = User::find($user->id)->companiesChats;

        foreach ($userChats as $chat) {
            $chat->load(['messages' => function ($query) {
                $query->latest()->first();
            }]);
        }
        return $userChats;
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
        $user_id = Auth::user()->id;

        Message::where('chat_id', $chat_id)
            ->where('sender_id', '!=', $user_id)
            ->where('read', true)
            ->update(['read' => false]);

        return  Message::where('chat_id', $chat_id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function send($data, $chat)
    {
        $user_id = Auth::user()->id;

        Message::where('chat_id', $chat->id)
            ->where('sender_id', '!=', $user_id)
            ->where('read', true)
            ->update(['read' => false]);

        $data['sender_id'] = $user_id;
        $data['chat_id'] = $chat->id;
        $data['read'] = true;

        $data['content'] = strip_tags($data['content'], '<a>');

        $message = new Message;
        $message->fill($data)->save();

        return $message;
    }
}
