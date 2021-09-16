<?php

namespace App\Repositories;

use App\Interfaces\SiteConfigurationsRepositoryInterface;
use App\Models\SiteConfiguration;

class SiteConfigurationsRepository implements SiteConfigurationsRepositoryInterface
{
    public function getAllConfigurations()
    {
        return SiteConfiguration::all();
    }

    public function getSiteConfigurationsArray()
    {
        return SiteConfiguration::pluck('value', 'identifier')->toArray();
    }

    public function updateConfigurations($request): bool
    {
        $requestData = $request->except('_token');
        foreach ($requestData['configurations'] as $key => $value){
            $data = SiteConfiguration::where('identifier', $key)->first();
            $data->update(['value' => $value ?? null]);
        }
        return true;
    }
}
