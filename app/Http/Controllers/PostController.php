<?php

namespace App\Http\Controllers;

use App\Services\PostService\applyPostService;
use App\Services\PostService\buyPinService;
use App\Services\PostService\cancelPostService;
use App\Services\PostService\confirmPostService;
use App\Services\PostService\deletePostService;
use App\Services\PostService\findPostsService;
use App\Services\PostService\showAllPostsService;
use App\Services\PostService\showAppliedPostsService;
use App\Services\PostService\showLatestPostsService;
use App\Services\PostService\showMyPostsService;
use App\Services\PostService\showPostService;
use App\Services\PostService\unapplyPostService;
use App\Services\PostService\updatePostService;
use Illuminate\Http\Request;
use App\Services\PostService\createPostService;

class PostController extends Controller
{
    protected $createPostService;
    protected $showMyPostsService;
    protected $showLatestPostsService;
    protected $showAppliedPostsService;
    protected $showAllPostsService;
    protected $updatePostService;
    protected $confirmPostService;
    protected $cancelPostService;
    protected $deletePostService;
    protected $showPostService;
    protected $applyPostService;
    protected $unapplyPostService;
    protected $buyPinService;
    protected $findPostsService;

    public function __construct(createPostService $createPostService, showMyPostsService $showMyPostsService, showLatestPostsService $showLatestPostsService, showAppliedPostsService $showAppliedPostsService, showAllPostsService $showAllPostsService, updatePostService $updatePostService, confirmPostService $confirmPostService, cancelPostService $cancelPostService, deletePostService $deletePostService, showPostService $showPostService, applyPostService $applyPostService, unapplyPostService $unapplyPostService, buyPinService $buyPinService, findPostsService $findPostsService)
    {
        $this->createPostService = $createPostService;
        $this->showMyPostsService = $showMyPostsService;
        $this->showLatestPostsService = $showLatestPostsService;
        $this->showAppliedPostsService = $showAppliedPostsService;
        $this->showAllPostsService = $showAllPostsService;
        $this->updatePostService = $updatePostService;
        $this->confirmPostService = $confirmPostService;
        $this->cancelPostService = $cancelPostService;
        $this->deletePostService = $deletePostService;
        $this->showPostService = $showPostService;
        $this->applyPostService = $applyPostService;
        $this->unapplyPostService = $unapplyPostService;
        $this->buyPinService = $buyPinService;
        $this->findPostsService = $findPostsService;
    }

    public function showAllPostsForm()
    {
        return $this->showAllPostsService->showAllPostsForm();
    }

    public function showMyPostsForm()
    {
        return $this->showMyPostsService->showMyPostsForm();
    }

    public function showLatestPostsForm(Request $request)
    {
        return $this->showLatestPostsService->showLatestPostsForm($request->input('page', 1));
    }

    public function showAppliedPostsForm()
    {
        return $this->showAppliedPostsService->showAppliedPostsForm();
    }

    public function showPostForm($id)
    {
        return $this->showPostService->showPostForm($id);
    }

    public function showCreatePostForm()
    {
        return $this->createPostService->showCreatePostForm();
    }

    public function createPost(Request $request)
    {
        return $this->createPostService->createPost($request->title, $request->work, $request->level, $request->experience, $request->skills, $request->degree, $request->workingForm, $request->sex, $request->city, $request->address, $request->minSalary, $request->maxSalary, $request->numberApplicants, $request->description, $request->benefit, $request->endDate);
    }

    public function showUpdatePostForm($id)
    {
        return $this->updatePostService->showUpdatePostForm($id);
    }

    public function updatePost(Request $request, $id)
    {
        return $this->updatePostService->updatePost($id, $request->title, $request->work, $request->level, $request->experience, $request->skills, $request->degree, $request->workingForm, $request->sex, $request->city, $request->address, $request->minSalary, $request->maxSalary, $request->numberApplicants, $request->description, $request->benefit, $request->endDate);
    }

    public function deletePost(Request $request)
    {
        return $this->deletePostService->deletePost($request->id);
    }

    public function confirmPost(Request $request)
    {
        return $this->confirmPostService->confirmPost($request->id);
    }

    public function cancelPost(Request $request)
    {
        return $this->cancelPostService->cancelPost($request->id, $request->note);
    }

    public function applyPost($id, Request $request)
    {
        return $this->applyPostService->applyPost($id, $request->id);
    }

    public function unapplyPost($id, Request $request)
    {
        return $this->unapplyPostService->unapplyPost($id, $request->id);
    }

    public function buyPin(Request $request)
    {
        return $this->buyPinService->buyPin($request->id);
    }

    public function findPosts(Request $request)
    {
        return $this->findPostsService->showFindPostsForm($request->search, $request->level, $request->city, $request->input('page', 1));
    }
}
