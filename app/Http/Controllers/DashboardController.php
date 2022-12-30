<?php

namespace App\Http\Controllers;

use App\Repositories\Cv\CvRepositoryInterface;
use App\Services\DashboardService\dashboardManager;
use Illuminate\Http\Request;
use App\Services\DashboardService\dashboardEmployer;

class DashboardController extends Controller
{
    protected $dashboardEmployer;
    protected $dashboardManager;

    public function __construct(dashboardEmployer $dashboardEmployer,dashboardManager $dashboardManager)
    {
        $this->dashboardEmployer = $dashboardEmployer;
        $this->dashboardManager = $dashboardManager;
    }

    public function dashboardEmployer()
    {
        return $this->dashboardEmployer->dashboardEmployer();
    }

    public function dashboardManager()
    {
        return $this->dashboardManager->dashboardManager();
    }
}
