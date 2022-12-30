<?php

namespace App\Http\Controllers;

use App\Services\CvService\buyCvService;
use App\Services\CvService\createCvService;
use App\Services\CvService\deleteCvService;
use App\Services\CvService\downloadCvService;
use App\Services\CvService\findCvService;
use App\Services\CvService\showAllCvsService;
use App\Services\CvService\showApplyCvsService;
use App\Services\CvService\showCvService;
use App\Services\CvService\showMyCvsService;
use App\Services\CvService\showPurchasedCvsService;
use App\Services\CvService\suggestCvService;
use App\Services\CvService\updateCvService;
use Illuminate\Http\Request;

class CvController extends Controller
{
    protected $createCvService;
    protected $updateCvService;
    protected $showAllCvsService;
    protected $downloadCvService;
    protected $deleteCvService;
    protected $showMyCvsService;
    protected $showCvService;
    protected $suggestCvService;
    protected $findCvService;
    protected $showApplyCvsService;
    protected $showPurchasedCvsService;
    protected $buyCvService;

    public function __construct(createCvService $createCvService, updateCvService $updateCvService, showAllCvsService $showAllCvsService, downloadCvService $downloadCvService, deleteCvService $deleteCvService, showMyCvsService $showMyCvsService, showCvService $showCvService, suggestCvService $suggestCvService, findCvService $findCvService, showApplyCvsService $showApplyCvsService, showPurchasedCvsService $showPurchasedCvsService, buyCvService $buyCvService)
    {
        $this->createCvService = $createCvService;
        $this->updateCvService = $updateCvService;
        $this->showAllCvsService = $showAllCvsService;
        $this->downloadCvService = $downloadCvService;
        $this->deleteCvService = $deleteCvService;
        $this->showMyCvsService = $showMyCvsService;
        $this->showCvService = $showCvService;
        $this->suggestCvService = $suggestCvService;
        $this->findCvService = $findCvService;
        $this->showApplyCvsService = $showApplyCvsService;
        $this->showPurchasedCvsService = $showPurchasedCvsService;
        $this->buyCvService = $buyCvService;
    }

    public function showAllCvsForm()
    {
        return $this->showAllCvsService->showAllCvsForm();
    }

    public function showCreateCvForm()
    {
        return $this->createCvService->showCreateCvForm();
    }

    public function createCv(Request $request)
    {
        return $this->createCvService->createCv($request->name, $request->position, $request->profile, $request->objective, $request->skills, $request->work_experience, $request->education, $request->activities, $request->certifications);
    }

    public function showUpdateCvForm($id)
    {
        return $this->updateCvService->showUpdateCvForm($id);
    }

    public function updateCv(Request $request, $id)
    {
        return $this->updateCvService->updateCv($id, $request->name, $request->position, $request->profile, $request->objective, $request->skills, $request->work_experience, $request->education, $request->activities, $request->certifications);
    }

    public function downloadCv($id)
    {
        return $this->downloadCvService->downloadCv($id);
    }

    public function deleteCv(Request $request)
    {
        return $this->deleteCvService->deleteCv($request->id);
    }

    public function showMyCvsForm()
    {
        return $this->showMyCvsService->showMyCvsForm();
    }

    public function showCvForm($id)
    {
        return $this->showCvService->showCvForm($id);
    }

    public function showSuggestCvForm($id)
    {
        return $this->suggestCvService->showSuggestCvForm($id);
    }

    public function showFindCvForm(Request $request)
    {
        return $this->findCvService->findCv($request->search, $request->city, $request->input('page', 1));
    }

    public function showApplyCvsForm($id)
    {
        return $this->showApplyCvsService->showApplyCvsForm($id);
    }

    public function showPurchasedCvsForm()
    {
        return $this->showPurchasedCvsService->showPurchasedCvsForm();
    }

    public function buyCv(Request $request)
    {
        return $this->buyCvService->buyCv($request->id);
    }
}
