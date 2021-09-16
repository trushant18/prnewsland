<?php

namespace App\Interfaces;

interface SiteConfigurationsRepositoryInterface
{
    public function getAllConfigurations();

    public function getSiteConfigurationsArray();

    public function updateConfigurations($request);
}
