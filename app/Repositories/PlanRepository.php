<?php

namespace App\Repositories;

use App\Interfaces\PlanRepositoryInterface;
use App\Models\Plan;

class PlanRepository implements PlanRepositoryInterface
{
    public function getAllPlan()
    {
        return Plan::all();
    }

    public function storePlan($request)
    {
        $requestData = $request->except('_token');
        if (isset($requestData['image'])) {
            $requestData['image'] = self::uploadImage($requestData);
        }
        Plan::create($requestData);
        return true;
    }

    public function getPlanDetails($id)
    {
        return Plan::findOrFail($id);
    }

    public function updatePlan($request, $id)
    {
        $requestData = $request->except('_token');
        $planDetail = self::getPlanDetails($id);
        if (isset($planDetail)) {
            $planDetail->update($requestData);
        }
        return true;
    }

    public function deletePlan($id)
    {
        Plan::destroy($id);
        return true;
    }
}