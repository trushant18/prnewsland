<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    const IMG_URL = "storage/blog/";
    const IMG_PATH = "app/public/blog/";

    protected $primaryKey = 'id';

    protected $table = 'blogs';

    protected $fillable = ['title', 'slug', 'short_content', 'content', 'image'];
}
