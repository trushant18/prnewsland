<?php

namespace App\Interfaces;

interface PageRepositoryInterface
{
    public function getAllPages();

    public function getPageTypes($id = null);

    public function storePage($request);

    public function getPageDetails($id);

    public function updatePage($request, $id);

    public function deletePage($id);
}