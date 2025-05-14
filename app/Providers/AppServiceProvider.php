<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\AuthRepository;
use App\Repositories\AuthRepositoryInterface;
use App\Services\AuthService;
use App\Services\AuthServiceInterface;
use App\Repositories\GoalRepository;

use App\Repositories\JournalInclassRepositoryInterface;
use App\Repositories\JournalInclassRepository;
use App\Services\JournalInclassServiceInterface;
use App\Services\JournalInclassService;

use App\Repositories\JournalSelfstudyRepositoryInterface;
use App\Repositories\JournalSelfstudyRepository;
use App\Services\JournalSelfstudyServiceInterface;
use App\Services\JournalSelfstudyService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Repositories\GoalRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
