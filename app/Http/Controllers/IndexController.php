<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use App\Services\indexService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    protected $indexService;

    public function __construct(indexService $indexService)
    {
        $this->indexService = $indexService;
    }

    public function index()
    {
        return $this->indexService->index();
    }

    public function showSearchResults()
    {

    }

    public function search(Request $request)
    {

    }
}
