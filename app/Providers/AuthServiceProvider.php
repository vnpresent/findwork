<?php

namespace App\Providers;

use App\Models\Cv;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('delete-post', function ($user, $post) {
            if (auth('employer')->user() != null && $post->employer_id == auth('employer')->user()->id) {
                return true;
            }
            if (auth('manager')->user() != null && auth('manager')->user()->hasPermission('delete_post')) {
                return true;
            }
            return false;
        });

        Gate::define('check', function ($user) {
            dd($user);
//            if (auth('manager')->user() != null && auth('manager')->user()->hasPermission($permission))
//                return true;
//            else
//                return false;
//            if ($cv = Cv::find($cv)) {
//                if (auth('applicant')->user() != null && $cv->applicant_id == auth('applicant')->user()->id) {
//                    return true;
//                }
//                if (auth('manager')->user() != null && auth('manager')->user()->hasPermission('delete_cv')) {
//                    return true;
//                }
//            }
//            return false;
        });
    }
}
