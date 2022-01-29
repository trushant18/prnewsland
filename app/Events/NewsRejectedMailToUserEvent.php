<?php

namespace App\Events;

use App\Models\News;
use App\Models\User;
use Illuminate\Queue\SerializesModels;

class NewsRejectedMailToUserEvent
{
    use SerializesModels;

    public $news;

    public function __construct(News $news)
    {
        $this->news = $news;
    }
}
