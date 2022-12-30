<?php

namespace App\Providers;

use App\Repositories\Applicant\ApplicantRepository;
use App\Repositories\Applicant\ApplicantRepositoryInterface;
use App\Repositories\Auth\AuthApplicantRepository;
use App\Repositories\Auth\AuthApplicantRepositoryInterface;
use App\Repositories\Auth\AuthEmployerRepository;
use App\Repositories\Auth\AuthEmployerRepositoryInterface;
use App\Repositories\Auth\AuthManagerRepository;
use App\Repositories\Auth\AuthManagerRepositoryInterface;
use App\Repositories\City\CityRepository;
use App\Repositories\City\CityRepositoryInterface;
use App\Repositories\Cv\CvRepository;
use App\Repositories\Cv\CvRepositoryInterface;
use App\Repositories\Degree\DegreeRepository;
use App\Repositories\Degree\DegreeRepositoryInterface;
use App\Repositories\Employer\EmployerRepository;
use App\Repositories\Employer\EmployerRepositoryInterface;
use App\Repositories\Experience\ExperienceRepository;
use App\Repositories\Experience\ExperienceRepositoryInterface;
use App\Repositories\Level\LevelRepository;
use App\Repositories\Level\LevelRepositoryInterface;
use App\Repositories\Manager\ManagerRepository;
use App\Repositories\Manager\ManagerRepositoryInterface;
use App\Repositories\Payment\PaymentRepository;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\Permission\PermissionRepository;
use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Repositories\Post\PostRepository;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\Setting\SettingRepository;
use App\Repositories\Setting\SettingRepositoryInterface;
use App\Repositories\Skill\SkillRepository;
use App\Repositories\Skill\SkillRepositoryInterface;
use App\Repositories\Train\TrainRepository;
use App\Repositories\Train\TrainRepositoryInterface;
use App\Repositories\VNPay\VNPayRepository;
use App\Repositories\VNPay\VNPayRepositoryInterface;
use App\Repositories\Work\WorkRepository;
use App\Repositories\Work\WorkRepositoryInterface;
use App\Repositories\WorkingForm\WorkingFormRepository;
use App\Repositories\WorkingForm\WorkingFormRepositoryInterface;
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
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(WorkRepositoryInterface::class, WorkRepository::class);
        $this->app->bind(LevelRepositoryInterface::class, LevelRepository::class);
        $this->app->bind(ExperienceRepositoryInterface::class, ExperienceRepository::class);
        $this->app->bind(DegreeRepositoryInterface::class, DegreeRepository::class);
        $this->app->bind(WorkingFormRepositoryInterface::class, WorkingFormRepository::class);
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(CvRepositoryInterface::class, CvRepository::class);
        $this->app->bind(SkillRepositoryInterface::class, SkillRepository::class);
        $this->app->bind(VNPayRepositoryInterface::class, VNPayRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(TrainRepositoryInterface::class, TrainRepository::class);
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
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
