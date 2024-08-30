<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id', 'amount', 'type', 'sender_id', 'recipient_id', 'balance_after'
    ];

    // Define the relationship for the sender
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Define the relationship for the recipient
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
}
