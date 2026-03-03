<?php

namespace App\Http\Controllers;

use App\Enums\PlanStatus;
use App\Http\Requests\Plan\CreateRequest;
use App\Http\Requests\Plan\UpdateRequest;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::all();
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
         $plan = Plan::create($validated_data);

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
        $plan->update($validated_data);

        return redirect()->route('admin.plan.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        $plan->delete();
        return redirect()->route('admin.plan.index');
    }

    public function filterPlans(string $status){
     
       $plans = $status === 'all' ? Plan::get() : Plan::where('status', $status)->get();

       return view('admin.plans._plan-cards', compact('plans'));

    }
}
