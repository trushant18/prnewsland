<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailTemplate extends Model
{
    use SoftDeletes;

    const EMAIL_EVENTS = [
        "user_register_activation" => "User Register Activation",
        "user_reset_password" => "User Reset Password"
    ];

    protected $primaryKey = 'id';

    protected $table = 'email_templates';

    protected $fillable = ['title', 'identifier', 'subject', 'content'];
}
