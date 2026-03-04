<?php

namespace App\Providers;

use App\Enums\UserStatus;
use App\Models\User;
use App\Repositories\AdminRepository;
use App\Repositories\Interfaces\AdminRepositoryInterface;
use App\Repositories\Interfaces\PlanRepositoryInterface;
use App\Repositories\PlanRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(PlanRepositoryInterface::class, PlanRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define("isAdmin", function (User $user) {
            return ($user->role === "admin" && $user->status === UserStatus::ACTIVE);
        });
    }
}
