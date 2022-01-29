<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    const IMG_URL = "storage/news/";
    const IMG_PATH = "app/public/news/";
    const CATEGORIES = [
        1 => 'New business',
        2 => 'New hire',
        3 => 'Book release',
        4 => 'Rebranding',
    ];
    const STATUS_LIST = [0 => 'Process', 1 => 'Approved', 2 => 'Rejected', 3 => 'Draft'];

    protected $primaryKey = 'id';

    protected $table = 'news';

    protected $fillable = ['user_id', 'title', 'slug', 'category', 'city', 'country', 'content', 'image', 'status', 'is_free', 'price'];

    public function userDetails(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
