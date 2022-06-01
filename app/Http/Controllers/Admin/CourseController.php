<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\CourseService;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    protected $service;

    public function __construct(CourseService $service) 
    {
        $this->service = $service;
    }

    public function index(Request $request) 
    {
        $courses = $this->service->getAll(
            filter: $request->filter ?? ""
        );

        return view('admin.courses.index', compact('courses'));
    }
}
