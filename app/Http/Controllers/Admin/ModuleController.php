<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateModule;
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

    public function index(Request $request, $courseId)
    {
        // se não encontrar o Curso
        if (!$course = $this->repositoryCourse->findById($courseId)) {
            return back();
        }

        $data = $this->repository->getAllByCourseId(
            courseId: $courseId,
            filter: $request->filter ?? ''
        );
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

    public function store(StoreUpdateModule $request, $courseId)
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

    public function update(StoreUpdateModule $request, $courseId, $id)
    {
        // se não encontrar o Curso
        if (!$this->repositoryCourse->findById($courseId)) {
            return back();
        }

        $this->repository->update($id, $request->only('name'));

        return redirect()->route('modules.index', $courseId);
    }

    public function show($courseId, $id)
    {
        // se não encontrar o Curso
        if (!$course = $this->repositoryCourse->findById($courseId)) {
            return back();
        }

        // se não encontrar o Modulo
        if (!$module = $this->repository->findById($id)) {
            return back();
        }

        return view('admin.courses.modules.show-modules', compact('course', 'module'));
    }

    public function destroy($courseId, $id)
    {
        // se não deletar, redireciona de volta
        if (!$this->repository->delete($id)) {
            return back();
        }

        return redirect()->route('modules.index', $courseId);
    }
}
