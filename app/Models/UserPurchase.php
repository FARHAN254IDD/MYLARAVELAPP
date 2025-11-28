<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPurchase extends Model
{
    protected $table = 'purchases';

    protected $fillable = [
        'user_id',
        'post_id',
        'amount',
        'status',
        'mpesa_receipt'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
