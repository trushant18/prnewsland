<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CreateCustomDirectories extends Command
{
    const DIRECTORY_PATH = [
        'app/public/blog' => 'blog',
        'app/public/user' => 'user',
    ];

    protected $signature = 'create:uploadable_directories';

    protected $description = 'This command will create the directories needed in the application and also create the symbolic link between storage and public/storage directory';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        foreach (self::DIRECTORY_PATH as $key => $path) {
            if (!File::isDirectory(storage_path($key))) {
                Storage::disk('public')->makeDirectory($path);
            }
        }
    }
}
