<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Queue\SerializesModels;

class NewsApprovalMailToAdminEvent
{
    use SerializesModels;

    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }
}
