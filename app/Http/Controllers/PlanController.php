<?php

namespace App\Http\Controllers;

use App\Enums\PlanStatus;
use App\Http\Requests\Plan\CreateRequest;
use App\Http\Requests\Plan\UpdateRequest;
use App\Models\Plan;
use App\Repositories\Interfaces\PlanRepositoryInterface;
use App\Traits\ToastrTrait;
use Illuminate\Http\Request;

class PlanController extends Controller
{

    use ToastrTrait;

    protected $planRepo;

     public function __construct(PlanRepositoryInterface $planRepo){
         $this->middleware("auth");
         $this->planRepo = $planRepo;
     }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = $this->planRepo->getAllPlans();
        return view('admin.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = PlanStatus::cases();
        return view('admin.plans.create', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
         $validated_data = $request->validated();
         $plan = $this->planRepo->createPlan($validated_data);

         if($plan){
            $this->toastrSuccess('Plan created successfully');
         }else{
            $this->toastrError('Failed to create plan');
         }

         return redirect()->route('admin.plan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        return view('admin.plans.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        $statuses = PlanStatus::cases();
        return view('admin.plans.edit', compact('plan', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Plan $plan)
    {
        $validated_data = $request->validated();
        $plan = $this->planRepo->updatePlan($plan, $validated_data);

        if($plan){
            $this->toastrSuccess('Plan updated successfully');
         }else{
            $this->toastrError('Failed to update plan');
         }  

        return redirect()->route('admin.plan.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        $this->planRepo->deletePlan($plan);

        if($plan){
            $this->toastrSuccess('Plan deleted successfully');
         }else{
            $this->toastrError('Failed to delete plan');
         }  
        return redirect()->route('admin.plan.index');
    }

    public function filterPlans(PlanStatus $status){
     
       $plans = $status === PlanStatus::ALL ? $this->planRepo->getAllPlans() : $this->planRepo->getPlanByStatus($status);

       return view('admin.plans._plan-cards', compact('plans'));

    }
}
