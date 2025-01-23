<?php

namespace App\Http\Controllers;

use App\Events\PrivateMessageEvent;
use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class ConversationController extends Controller
{
    public function getContact()
    {
        $contacts = Conversation::query()
            ->where('user_one_id', auth()->id())
            ->orWhere('user_two_id', auth()->id())
            ->with('userOne', 'userTwo')
            ->get();

        if ($contacts->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No conversations found.',
            ], 404);
        }
        $contacts->transform(function ($contact) {
            $contact->user = $contact->userOne->id === auth()->id() ? $contact->userTwo : $contact->userOne;
            $contact->unread_messages = $contact->getUnreadMessagesCount(auth()->id());
            $contact->latest_message = $contact->getLatestMessage();
            $contact->receiver_id = $contact->userOne->id === auth()->id() ? $contact->userTwo->id : $contact->userOne->id;
            return [
                'id' => $contact->id,
                'name' => $contact->user->name,
                'unread_messages' => $contact->unread_messages,
                'last_message' => $contact->latest_message->message,
                'receiver_id' => $contact->receiver_id,
                'created_at' => $contact->latest_message->created_at->format('d M, Y'),
            ];
        });
        return response()->json($contacts);
    }

    // public function getConversation($id)
    // {
    //     $conversation = Conversation::findOrfail($id);

    //     $conversation = [
    //         'id' => $conversation->id,
    //         'auth' => auth()->id(),
    //         'receiver_id' => $conversation->receiver_id,
    //         'sender_id' => $conversation->sender_id,
    //         'receiver' => $conversation->receiver->name,
    //         'sender' => $conversation->sender->name,
    //         'created_at' => $conversation->created_at->format('d M, Y'),
    //         'messages' => $conversation->messages->transform(function ($message) {
    //             return [
    //                 'id' => $message->id,
    //                 'auth' => auth()->id(),
    //                 'sender_id' => $message->conversation->sender_id,
    //                 'sender' => $message->conversation->sender->name,
    //                 'receiver_id' => $message->conversation->receiver_id,
    //                 'receiver' => $message->conversation->receiver->name,
    //                 'user_id' => $message->user_id,
    //                 'body' => $message->body,
    //                 'created_at' => $message->created_at->format('d M, h:i a') ?? '',
    //             ];
    //         }),
    //     ];

    //     return response()->json($conversation);
    // }



     /**
     * Get all Messages in a Conversation.
     */
    public function getMessages(Request $request, $conversationId)
    {
        $perPage = $request->per_page ?? 10;
        $conversation = Conversation::findOrFail($conversationId);
        // return auth()->user();
        $messages = $conversation->getMessages($perPage);
        // $messages = $conversation->getMessages();

        $messages->transform(function ($message) {

            $message->is_sender = $message->sender_id == auth()->id();
            $message->media = $message->media ? asset('storage/'. $message->media) : null;
            // $message->created_at = $message->created_at->format('d M, h:i a') ?? '';
            $message->created_at_formatted = Carbon::parse($message->created_at)->format('d M, h:i a');
            return $message;
        });

        //desc order
        // $messages = $messages->sortByDesc('created_at');

        return response()->json([
            'success' => true,
            'user_id' => auth()->id(),
            'receiver_id' => $conversation->user_one_id == auth()->id() ? $conversation->user_two_id : $conversation->user_one_id,
            'messages' => $messages,
        ]);
    }


    // public function sendMessage(Request $request)
    // {
    //     // dd($request->all());

    //     // $receiver_id = $request->receiver_id;
    //     // $sender_id = auth()->id();
    //     // $message_body = $request->body;



    //     // $conversation = Conversation::firstOrCreate([
    //     //     'sender_id' => $sender_id,
    //     //     'receiver_id' => $receiver_id,
    //     // ]);

    //     // dd($conversation);

    //     // event(new PrivateMessageEvent([
    //     //     'receiver_id' => $receiver_id,
    //     //     'sender_id' => $sender_id,
    //     //     'msg' => $message_body,
    //     // ]));

    //     $message = Message::create([
    //         'conversation_id' => $request->conversation_id,
    //         'user_id' => auth()->id(),
    //         'body' => $request->body,
    //     ]);

    //     $data = [
    //         'id' => $message->id,
    //         'sender_id' => $message->conversation->sender_id,
    //         'sender' => $message->conversation->sender->name,
    //         'receiver_id' => $message->conversation->receiver_id,
    //         'receiver' => $message->conversation->receiver->name,
    //         'user_id' => $message->user_id,
    //         'auth' => auth()->id(),
    //         'body' => $message->body,
    //         'created_at' => $message->created_at->format('d M, h:i a'),
    //     ];

    //     event(new PrivateMessageEvent($data));

    //     // Redis::publish('private-channel', json_encode([
    //     //     'event' => 'PrivateMessageEvent',
    //     //     'message' => $data,
    //     // ]));
    //     // return response()->json([
    //     //     'status' => 'success',
    //     //     'message' => [
    //     //         'id' => $message->id,
    //     //         'sender_id' => $message->conversation->sender_id,
    //     //         'sender' => $message->conversation->sender->name,
    //     //         'receiver_id' => $message->conversation->receiver_id,
    //     //         'receiver' => $message->conversation->receiver->name,
    //     //         'user_id' => $message->user_id,
    //     //         'auth' => auth()->id(),
    //     //         'body' => $message->body,
    //     //         'created_at' => $message->created_at->format('d M, h:i a'),
    //     //     ],
    //     // ]);

    //     return response()->json($data);
    // }

/**
     * Send a Message.
     */
    public function sendMessage(Request $request)
    {
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'receiver_id' => 'required|exists:users,id',
            'message' => 'nullable',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,mp3,wav,ogg,avi,flv,webm|max:20480',
            // 'media_type' => 'nullable|in:text,image,video,audio',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $sender = auth()->id();
        // return $sender;
        $receiver = $request->receiver_id;

        if($sender == $receiver) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot send a message to yourself.',
            ], 400);
        }

        // Check if a conversation already exists
        $conversation = Conversation::where(function ($query) use ($sender, $receiver) {
            $query->where('user_one_id', $sender)
                ->where('user_two_id', $receiver);
        })->orWhere(function ($query) use ($sender, $receiver) {
            $query->where('user_one_id', $receiver)
                ->where('user_two_id', $sender);
        })->first();

        // Create a conversation if it doesn't exist
        if (!$conversation) {
            $conversation = Conversation::create([
                'user_one_id' => $sender,
                'user_two_id' => $receiver,
            ]);
        }

        // Handle media upload (if applicable)
        $mediaPath = null;
        if ($request->hasFile('media')) {

            $file = $request->file('media');
            $extension = $file->getClientOriginalExtension();
            $mediaType = 'text';
            if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                $mediaType = 'image';
            } elseif (in_array($extension, ['mp4', 'avi', 'flv', 'webm'])) {
                $mediaType = 'video';
            } elseif (in_array($extension, ['mp3', 'wav', 'ogg'])) {
                $mediaType = 'audio';
            }
            $mediaPath = $request->file('media')->store('messages/media', 'public');
        }
        // return $sender;
        // Save the message
        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $sender,
            'receiver_id' => $receiver,
            'message' => $request->message ?? null,
            'media' => $mediaPath,
            'media_type' => $mediaType ?? 'text',
            'status' => 'sent',
        ]);

        $is_sender = $message->sender_id == auth()->id();
        $message->is_sender = $is_sender;
        $message->created_at_formatted = Carbon::parse($message->created_at)->format('d M, h:i a');
        $message->sender_name = auth()->user()->name;


        // Notify the receiver (if applicable)
        // $receiverUser = User::find($receiver);
        // $receiverUser->notify(new \App\Notifications\MessageReceived($message));

        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully.',
            'data' => $message,
        ]);
    }

    /**
     * Mark a Message as Read.
     */
    public function markAsRead($conversationId)
    {
        $conversation = Conversation::findOrFail($conversationId);

        $conversation->markMessagesAsRead(auth()->id());

        return response()->json([
            'success' => true,
            'message' => 'Messages marked as read.',
        ]);
    }

}
