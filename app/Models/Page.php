<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    const PAGE_TYPES = [
        "about-us" => "About Us",
        "privacy-policy" => "Privacy Policy",
        "terms-and-conditions" => "Terms & Conditions"
    ];

    protected $primaryKey = 'id';

    protected $table = 'pages';

    protected $fillable = ['title', 'type', 'content'];
}
