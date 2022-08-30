<?php

namespace App\Providers;

use App\Interfaces\Auth\AuthApplicantRepositoryInterface;
use App\Interfaces\Auth\AuthEmployerRepositoryInterface;
use App\Interfaces\Auth\AuthManagerRepositoryInterface;
use App\Repositories\Auth\AuthApplicantRepository;
use App\Repositories\Auth\AuthEmployerRepository;
use App\Repositories\Auth\AuthManagerRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthApplicantRepositoryInterface::class, AuthApplicantRepository::class);
        $this->app->bind(AuthEmployerRepositoryInterface::class, AuthEmployerRepository::class);
        $this->app->bind(AuthManagerRepositoryInterface::class, AuthManagerRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
