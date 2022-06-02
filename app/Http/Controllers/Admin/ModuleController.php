<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CourseRepositoryInterface;
use App\Repositories\ModuleRepositoryInterface;

class ModuleController extends Controller
{
    protected $repository;
    protected $repositoryCourse;

    public function __construct(
        CourseRepositoryInterface $repositoryCourse,
        ModuleRepositoryInterface $repository
    ) {
        $this->repository = $repository;
        $this->repositoryCourse = $repositoryCourse;
    }

    public function index($courseId)
    {
        // se não encontrar o Curso
        if (!$course = $this->repositoryCourse->findById($courseId)) {
            return back();
        }

        $data = $this->repository->getAllByCourseId($courseId);
        $modules = convertItemsOfArrayToObject($data);
        // não podemos acessar direto $modules->course, vamos injetar o repositorio de curso no construtor e pegar o curso

        return view('admin.courses.modules.index-modules', compact('course', 'modules'));
    }

    public function create($courseId)
    {
        // se não encontrar o Curso
        if (!$course = $this->repositoryCourse->findById($courseId)) {
            return back();
        }

        return view('admin.courses.modules.create-modules', compact('course'));
    }

    public function store(Request $request, $courseId)
    {
        // se não encontrar o Curso
        if (!$course = $this->repositoryCourse->findById($courseId)) {
            return back();
        }

        $this->repository
                ->createByCourse($courseId, $request->only(['name']));

        // dessa maneira já cadastra o modulo para esse $course
        // $course->modules()-create($request->only(['name']));

        return redirect()->route('modules.index', $courseId);
    }

    public function edit($courseId, $id)
    {
        // se não encontrar o Curso
        if (!$course = $this->repositoryCourse->findById($courseId)) {
            return back();
        }

        // se não encontrar o Modulo
        if (!$module = $this->repository->findById($id)) {
            return back();
        }

        return view('admin.courses.modules.edit-modules', compact('course', 'module'));
    }

    public function update(Request $request, $courseId, $id)
    {
        // se não encontrar o Curso
        if (!$this->repositoryCourse->findById($courseId)) {
            return back();
        }

        $this->repository->update($id, $request->only('name'));

        return redirect()->route('modules.index', $courseId); 
    }
}
