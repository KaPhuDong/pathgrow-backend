<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\AuthRepository;
use App\Repositories\AuthRepositoryInterface;
use App\Services\AuthService;
use App\Services\AuthServiceInterface;
use App\Repositories\GoalRepositoryInterface;
use App\Repositories\GoalRepository;
use App\Services\GoalServiceInterface;
use App\Services\GoalService;

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
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(GoalRepositoryInterface::class, GoalRepository::class);
        $this->app->bind(GoalServiceInterface::class, GoalService::class);

        // Đăng ký JournalInclass
        $this->app->bind(JournalInclassRepositoryInterface::class, JournalInclassRepository::class);
        $this->app->bind(JournalInclassServiceInterface::class, JournalInclassService::class);

        // Đăng ký JournalSelfstudy
        $this->app->bind(JournalSelfstudyRepositoryInterface::class, JournalSelfstudyRepository::class);
        $this->app->bind(JournalSelfstudyServiceInterface::class, JournalSelfstudyService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
