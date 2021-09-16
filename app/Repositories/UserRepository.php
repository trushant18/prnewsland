<?php

namespace App\Repositories;

use App\Interfaces\BlogRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Blog;
use App\Models\Page;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers()
    {
        return User::orderBy('id', 'DESC')->get();
    }
}