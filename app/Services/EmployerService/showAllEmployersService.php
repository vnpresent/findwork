<?php

namespace App\Services\EmployerService;


use App\Repositories\Employer\EmployerRepositoryInterface;

class showAllEmployersService
{
    protected $employerRepository;

    public function __construct(EmployerRepositoryInterface $employerRepository)
    {
        $this->employerRepository = $employerRepository;
    }

    public function showAllEmployersForm()
    {
//        try {
            $employers = $this->employerRepository->getAllEmployers();
            return view('employer.show_all_employers', ['employers' => $employers]);
//        } catch (\Exception $e) {
//            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra,vui lòng thử lại sau'])->withInput();
//        }
    }
}
