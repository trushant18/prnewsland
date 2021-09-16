<?php

namespace App\Http\Controllers;

use App\Interfaces\SiteConfigurationsRepositoryInterface;
use Illuminate\Http\Request;

class SiteConfigurationsController extends Controller
{
    protected $siteConfigurationsRepository;

    public function __construct(SiteConfigurationsRepositoryInterface $siteConfigurationsRepository)
    {
        $this->siteConfigurationsRepository = $siteConfigurationsRepository;
    }

    public function index()
    {
        $site_configurations = $this->siteConfigurationsRepository->getAllConfigurations();
        return view('admin.site_configurations.index', compact('site_configurations'));
    }

    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->siteConfigurationsRepository->updateConfigurations($request);
        return redirect()->route('admin.site_configurations')->with('success', 'Data Updated Successfully.');
    }
}
