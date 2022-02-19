<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'transactions';

    protected $fillable = ['user_id', 'news_id', 'price', 'payment_id', 'type', 'details'];

    public function userDetails(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
