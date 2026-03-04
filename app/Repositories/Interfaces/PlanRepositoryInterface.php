<?php

namespace App\Repositories\Interfaces;

use App\Enums\PlanStatus;
use App\Models\Plan;

interface PlanRepositoryInterface
{
    public function getAllPlans();

    public function createPlan(array $data);

    public function getPlanByStatus(PlanStatus $planStatus);

    public function updatePlan(Plan $plan, array $data);

    public function deletePlan(Plan $plan); 
}
