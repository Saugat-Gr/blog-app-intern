<?php

namespace App\Models;

use App\Enums\PlanStatus;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['name', 'description', 'status', 'price', 'duration_days'];

    protected function casts(){
         return [
             'status' => PlanStatus::class,
         ];
    }


        public function getStatusColorAttribute()
    {
        return match ($this->status) {
            PlanStatus::ACTIVE => 'success',
            PlanStatus::INACTIVE => 'danger',
            default => 'secondary',
        };
    }
}
