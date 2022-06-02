<?php

namespace App\Http\Controllers\Admin;

use App\Services\UploadFile;
use Illuminate\Http\Request;
use App\Services\CourseService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Course\StoreUpdateCourse;

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

    public function create() 
    {
        return view('admin.courses.create');
    }

    public function store(StoreUpdateCourse $request, UploadFile $uploadFile) 
    {
        $data = $request->only('name');
        $data['available'] = isset($request->available); // se existir, retorna 'true'

        if ($request->image) {
            $data['image'] = $uploadFile->store($request->image, 'courses');
        }

        $this->service->create($data);

        return redirect()->route('courses.index');
    }

    public function edit($id) 
    {
        if (!$course = $this->service->findById($id)) {
            return back();
        }

        return view('admin.courses.edit', compact('course'));
    }

    public function update(StoreUpdateCourse $request, UploadFile $uploadFile, $id) 
    {
        $data = $request->only('name');
        $data['available'] = isset($request->available); // se existir, retorna 'true'

        if ($request->image) {
            $course = $this->service->findById($id);

            if ($course && $course->image) { // se encontrou o curso e ele já tinha uma imagem, vamos deletar a imagem antes de atualiza-la/ inseri-la
                $uploadFile->removeFile($course->image);
            }

            $data['image'] = $uploadFile->store($request->image, 'courses');
        }

        $this->service->update($id, $data);

        return redirect()->route('courses.index');
    }
}
