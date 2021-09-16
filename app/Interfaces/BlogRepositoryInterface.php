<?php

namespace App\Interfaces;

interface BlogRepositoryInterface
{
    public function getAllBlog();

    public function storeBlog($request);

    public function getBlogDetails($id);

    public function updateBlog($request, $id);

    public function deleteBlog($id);
}