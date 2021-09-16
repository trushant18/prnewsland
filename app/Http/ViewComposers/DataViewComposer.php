<?php

namespace App\Http\ViewComposers;

use App\Interfaces\SiteConfigurationsRepositoryInterface;
use Illuminate\Contracts\View\View;

class DataViewComposer
{
    protected $siteConfigurationsRepository;

    public function __construct(SiteConfigurationsRepositoryInterface $siteConfigurationsRepository)
    {
        $this->siteConfigurationsRepository = $siteConfigurationsRepository;
    }

    public function compose(View $view)
    {
        $site_configuration = $this->siteConfigurationsRepository->getSiteConfigurationsArray();
        $view->with(['site_configuration' => $site_configuration]);
    }
}
