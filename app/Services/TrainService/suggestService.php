<?php

namespace App\Services\TrainService;

use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\Train\TrainRepositoryInterface;
use App\Repositories\Work\WorkRepositoryInterface;

class suggestService
{
    protected $workRepository;
    protected $trainRepository;
    protected $postRepository;

    public function __construct(WorkRepositoryInterface $workRepository, TrainRepositoryInterface $trainRepository, PostRepositoryInterface $postRepository)
    {
        $this->workRepository = $workRepository;
        $this->trainRepository = $trainRepository;
        $this->postRepository = $postRepository;
    }

    public function suggest($skill_ids)
    {
        $works = $this->workRepository->getAllWorks();
        $max_work_id = 0;
        $max_value = 0;
        foreach ($works as $work) {
            $work_id = $work['id'];
            $value = 1;
            foreach ($skill_ids as $skill_id) {
                $data = $this->trainRepository->getValue($skill_id, $work_id)[0]->value;
                $value = $value * $data;
            }
            $data = $this->trainRepository->getValue(null, $work_id)[0]->value;
            $value = $value * $data;
            if ($value > $max_value) {
                $max_value = $value;
                $max_work_id = $work_id;
            }
        }
//        dd($max_work_id);
        return $this->postRepository->getPostsByWorkId($max_work_id);
    }
}
