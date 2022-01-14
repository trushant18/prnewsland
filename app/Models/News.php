<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    const IMG_URL = "storage/news/";
    const IMG_PATH = "app/public/news/";
    const CATEGORIES = [
        1 => 'Category 1',
        2 => 'Category 2',
        3 => 'Category 3',
    ];

    protected $primaryKey = 'id';

    protected $table = 'news';

    protected $fillable = ['user_id', 'title', 'category', 'city', 'country', 'content', 'image', 'status', 'is_free'];
}
