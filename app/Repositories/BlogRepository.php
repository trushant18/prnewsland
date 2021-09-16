<?php

namespace App\Repositories;

use App\Interfaces\BlogRepositoryInterface;
use App\Models\Blog;
use App\Models\Page;

class BlogRepository implements BlogRepositoryInterface
{
    public function getAllBlog()
    {
        return Blog::all();
    }

    public function storeBlog($request)
    {
        $requestData = $request->except('_token');
        if (isset($requestData['image'])) {
            $requestData['image'] = self::uploadImage($requestData);
        }
        Blog::create($requestData);
        return true;
    }

    public function uploadImage($requestData, $blog = NULL): string
    {
        $file = $requestData['image'];
        $uploadPath = storage_path(Blog::IMG_PATH);
        if (isset($blog)) {
            $imagePath = $uploadPath . $blog->image;
            @unlink($imagePath);
        }
        $extension = $file->getClientOriginalExtension();
        $fileName = rand(11111, 99999) . '.' . $extension;
        $file->move($uploadPath, $fileName);
        return $fileName;
    }

    public function getBlogDetails($id)
    {
        return Blog::findOrFail($id);
    }

    public function updateBlog($request, $id)
    {
        $requestData = $request->except('_token');
        $blogDetail = self::getBlogDetails($id);
        if (isset($blogDetail)) {
            if (isset($requestData['image'])) {
                $requestData['image'] = self::uploadImage($requestData, $blogDetail);
            }
            $blogDetail->update($requestData);
        }
        return true;
    }

    public function deleteBlog($id)
    {
        $blogDetail = self::getBlogDetails($id);
        if (isset($blogDetail)){
            @unlink(storage_path(Blog::IMG_PATH.$blogDetail->image));
            $blogDetail->delete();
        }
        return true;
    }
}
