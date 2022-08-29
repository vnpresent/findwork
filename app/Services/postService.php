<?php

namespace App\Services;

use App\Models\Post;
use App\Services\ValidateInputServices\validateInputPostService;

class postService
{
    protected $validateInputPostService;

    public function __construct(validateInputPostService $validateInputPostService)
    {
        $this->validateInputPostService = $validateInputPostService;
    }

    // trả về form tao mới post
    public function showCreatePostForm()
    {
        return view('employer.create_post');
    }

    // xử lý tạo mới post
    public function createPost($title, $description, $number_applicants, $min_salary, $max_salary, $start_date, $end_date)
    {
        try {
            // validate các thông tin employer gửi lên,nếu thất bại,quay trở lại kèm lỗi
            $validate = $this->validateInputPostService->validateCreatePost($title, $description, $number_applicants, $min_salary, $max_salary, $start_date, $end_date);
            if ($validate !== true) {
                return redirect()->back()->with(['error' => $validate])->withInput();
            }
            Post::create([
                'employer_id' => auth('employer')->user()->id,
                'title' => $title,
                'description' => $description,
                'number_applicants' => $number_applicants,
                'min_salary' => $min_salary,
                'max_salary' => $max_salary,
                'start_date' => $start_date,
                'end_date' => $end_date,
            ]);
            return redirect()->back()->with(['success' => 'Đã tạo post mới thành công thành công']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Thất bại,có lỗi sảy ra'])->withInput();
        }

    }
}
