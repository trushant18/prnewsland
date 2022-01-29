<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailTemplate extends Model
{
    use SoftDeletes;

    const EMAIL_EVENTS = [
        "user_register_activation" => "User Register Activation",
        "user_reset_password" => "User Reset Password",
        "news_approval_mail_to_admin" => "Send News Approval Mail To Admin",
        "news_approved_mail_to_user" => "News Approved Mail To User",
        "news_rejected_mail_to_user" => "News Rejected Mail To User",
    ];

    protected $primaryKey = 'id';

    protected $table = 'email_templates';

    protected $fillable = ['title', 'identifier', 'subject', 'content'];
}
