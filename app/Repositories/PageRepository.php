<?php

namespace App\Repositories;

use App\Interfaces\PageRepositoryInterface;
use App\Models\Page;

class PageRepository implements PageRepositoryInterface
{
    public function getAllPages()
    {
        return Page::all();
    }

    public function getPageTypes($id = null)
    {
        $titles = [];
        $exist_record_actions = Page::whereNotNull('id');
        if (isset($id)){
            $exist_record_actions = $exist_record_actions->where('id', '!=', $id);
        }
        $exist_record_actions = $exist_record_actions->pluck('type')->toArray();
        $actions = Page::PAGE_TYPES;
        foreach ($actions as $key => $value) {
            if (!in_array($key, $exist_record_actions)){
                $titles[$key] = $value;
            }
        }
        return $titles;
    }

    public function storePage($request)
    {
        $requestData = $request->except('_token');
        Page::create($requestData);
        return true;
    }

    public function getPageDetails($id)
    {
        return Page::findOrFail($id);
    }

    public function updatePage($request, $id)
    {
        $requestData = $request->except('_token');
        $pageDetail = self::getPageDetails($id);
        if (isset($pageDetail)){
            $pageDetail->update($requestData);
        }
        return true;
    }

    public function deletePage($id)
    {
        return Page::destroy($id);
    }
}