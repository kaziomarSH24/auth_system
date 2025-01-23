<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
    //user_one_id
    public function userOne()
    {
        return $this->belongsTo(User::class, 'user_one_id');
    }

    //user_two_id
    public function userTwo()
    {
        return $this->belongsTo(User::class, 'user_two_id');
    }

    public function getMessages($perPage = 10)
    {
        return $this->messages()->with('sender', 'receiver')->orderBy('created_at', 'desc')->paginate($perPage);
    }
    // public function getMessages()
    // {
    //     return $this->messages()->with('sender','receiver')->get();
    // }

    public function getUnreadMessagesCount($userId)
    {
        return $this->messages()->where('sender_id', '!=', $userId)->where('status','!=', 'read')->count();
    }

    public function markMessagesAsRead($userId)
    {
        return $this->messages()->where('sender_id', '!=', $userId)->update([
            'status' => 'read',
            'read_at' => now()
        ]);
    }

    public function getLatestMessage()
    {
        return $this->messages()->latest()->first();
    }
}
