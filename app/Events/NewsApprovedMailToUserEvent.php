<?php

namespace App\Events;

use App\Models\News;
use Illuminate\Queue\SerializesModels;

class NewsApprovedMailToUserEvent
{
    use SerializesModels;

    public $news;
    public function __construct(News $news)
    {
        $this->news = $news;
    }
}
