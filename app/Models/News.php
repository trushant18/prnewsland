<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    const IMG_URL = "storage/news/";
    const IMG_PATH = "app/public/news/";

    protected $primaryKey = 'id';

    protected $table = 'news';

    protected $fillable = ['title', 'category', 'short_content', 'content', 'image'];
}
