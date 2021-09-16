<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteConfiguration extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'site_configurations';

    protected $fillable = ['title', 'identifier', 'value', 'control_type'];
}
