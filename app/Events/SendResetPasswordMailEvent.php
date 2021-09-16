<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Queue\SerializesModels;

class SendResetPasswordMailEvent
{
    use SerializesModels;

    public function __construct($data)
    {
        $this->data = $data;
    }
}
