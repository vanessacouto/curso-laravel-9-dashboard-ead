<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ModuleRepositoryInterface;

class ModuleController extends Controller
{
    protected $repository;

    public function __construct(ModuleRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index($courseId)
    {
        $this->repository->getAllByCourseId($courseId);
    }
}
