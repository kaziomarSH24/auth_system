<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function getContact()
    {
        $contacts = Conversation::query()
            ->where('sender_id', auth()->id())
            ->orWhere('receiver_id', auth()->id())
            ->with('messages')
            ->get();
        $contacts = $contacts->transform(function ($contact) {
            return[
                'id' => $contact->id,
                'receiver_id' => $contact->receiver_id,
                'sender_id' => $contact->sender_id,
                'auth' => auth()->id(),
                'receiver' => $contact->receiver->name,
                'sender' => $contact->sender->name,
                'last_message' => $contact->messages->last()->body,
                'created_at' => $contact->created_at->format('d M, Y'),
            ];
        });
        return response()->json($contacts);
    }

    public function getConversation($id)
    {
        $conversation = Conversation::findOrfail($id);

        $conversation = [
            'id' => $conversation->id,
            'auth' => auth()->id(),
            'receiver_id' => $conversation->receiver_id,
            'sender_id' => $conversation->sender_id,
            'receiver' => $conversation->receiver->name,
            'sender' => $conversation->sender->name,
            'created_at' => $conversation->created_at->format('d M, Y'),
            'messages' => $conversation->messages->transform(function ($message) {
                return [
                    'id' => $message->id,
                    'sender_id' => $message->conversation->sender_id,
                    'sender' => $message->conversation->sender->name,
                    'receiver_id' => $message->conversation->receiver_id,
                    'receiver' => $message->conversation->receiver->name,
                    'user_id' => $message->user_id,
                    'body' => $message->body,
                    'created_at' => $message->created_at->format('d M, h:i a'),
                ];
            }),
        ];
        
        return response()->json($conversation);
    }


    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'conversation_id' => $request->conversation_id,
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => [
                'id' => $message->id,
                'sender_id' => $message->conversation->sender_id,
                'sender' => $message->conversation->sender->name,
                'receiver_id' => $message->conversation->receiver_id,
                'receiver' => $message->conversation->receiver->name,
                'user_id' => $message->user_id,
                'body' => $message->body,
                'created_at' => $message->created_at->format('d M, h:i a'),
            ],
        ]);
    }
}
