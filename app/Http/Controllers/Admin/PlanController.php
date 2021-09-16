<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidatePlans;
use App\Interfaces\PlanRepositoryInterface;

class PlanController extends Controller
{
    protected $planRepository;

    public function __construct(PlanRepositoryInterface $planRepository)
    {
        $this->planRepository = $planRepository;
    }

    public function index()
    {
        $plans = $this->planRepository->getAllPlan();
        return view('admin.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.plans.create');
    }

    public function store(ValidatePlans $request)
    {
        $this->planRepository->storePlan($request);
        return redirect()->route('admin.plans')->with('success', 'Data Created Successfully.');
    }

    public function edit($id)
    {
        $plan = $this->planRepository->getPlanDetails($id);
        return view('admin.plans.edit', compact('plan'));
    }

    public function update(ValidatePlans $request, $id)
    {
        $this->planRepository->updatePlan($request, $id);
        return redirect()->route('admin.plans')->with('success', 'Data Updated Successfully.');
    }

    public function delete($id)
    {
        $this->planRepository->deletePlan($id);
        return redirect()->route('admin.plans')->with('success', 'Data Deleted Successfully.');
    }
}