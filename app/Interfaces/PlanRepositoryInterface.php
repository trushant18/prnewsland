<?php

namespace App\Interfaces;

interface PlanRepositoryInterface
{
    public function getAllPlan();

    public function storePlan($request);

    public function getPlanDetails($id);

    public function updatePlan($request, $id);

    public function deletePlan($id);
}