<?php

namespace App\Providers;

use App\Interfaces\ApplicantRepositoryInterface;
use App\Interfaces\Auth\AuthApplicantRepositoryInterface;
use App\Interfaces\Auth\AuthEmployerRepositoryInterface;
use App\Interfaces\Auth\AuthManagerRepositoryInterface;
use App\Interfaces\EmployerRepositoryInterface;
use App\Interfaces\ManagerRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Repositories\ApplicantRepository;
use App\Repositories\Auth\AuthApplicantRepository;
use App\Repositories\Auth\AuthEmployerRepository;
use App\Repositories\Auth\AuthManagerRepository;
use App\Repositories\EmployerRepository;
use App\Repositories\ManagerRepository;
use App\Repositories\PostRepository;
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
        // auth
        $this->app->bind(AuthApplicantRepositoryInterface::class, AuthApplicantRepository::class);
        $this->app->bind(AuthEmployerRepositoryInterface::class, AuthEmployerRepository::class);
        $this->app->bind(AuthManagerRepositoryInterface::class, AuthManagerRepository::class);

        // Model
        $this->app->bind(ApplicantRepositoryInterface::class, ApplicantRepository::class);
        $this->app->bind(EmployerRepositoryInterface::class, EmployerRepository::class);
        $this->app->bind(ManagerRepositoryInterface::class, ManagerRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
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
