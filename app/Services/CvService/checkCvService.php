<?php

namespace App\Services\CvService;

use App\Repositories\Cv\CvRepositoryInterface;
use App\Traits\CheckExistTrait;

class checkCvService
{
    use CheckExistTrait;

    protected $cvRepository;

    public function __construct(CvRepositoryInterface $cvRepository)
    {
        $this->cvRepository = $cvRepository;
    }

    public function checkCv($id)
    {
        $cv = $this->cvRepository->getCv($id);
        if ($this->checkExistsCv($cv) !== true) {
            return false;
        }
        if (auth('applicant')->user() != null && $cv['applicant_id'] == auth('applicant')->user()->id) {
            return true;
        }
        if (auth('employer')->user() != null) {
            $applies_id = array_column(auth('employer')->user()->getCvs->toArray(), 'id');
            if (in_array($id, $applies_id)) {
                return true;
            }
            $applies_id = $this->cvRepository->getCvsOfEmployerPosts(auth('employer')->user()->id);
            if (in_array($id, $applies_id)) {
                return true;
            }
        }
        if (auth('manager')->user() != null && auth('manager')->user()->hasPermission('download_cv')) {
            return true;
        }
        return false;
    }
}
