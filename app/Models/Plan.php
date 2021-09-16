<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $table = 'plans';

    protected $fillable = ['title', 'content', 'price'];
}
