<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    use HasFactory;

    

    public function messages():HasMany
    {
        return $this->hasMany(Message::class);
    }
    public function sender():BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver():BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
