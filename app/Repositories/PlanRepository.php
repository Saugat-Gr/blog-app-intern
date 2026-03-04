<?php

namespace App\Repositories;

use App\Models\Plan;
use App\Enums\PlanStatus;
use App\Repositories\Interfaces\PlanRepositoryInterface;

class PlanRepository implements PlanRepositoryInterface
{
    public function getAllPlans(){
        return Plan::all();
    }

    public function createPlan(array $data){
        return Plan::create($data);
    }

    public function getPlanByStatus(PlanStatus $planStatus){
        return Plan::where('status', $planStatus)->get();
    }       


    public function updatePlan(Plan $plan, array $data){
        $plan->update($data);
        return $plan;
    }       

    public function deletePlan(Plan $plan){
        return $plan->delete();
    }

}