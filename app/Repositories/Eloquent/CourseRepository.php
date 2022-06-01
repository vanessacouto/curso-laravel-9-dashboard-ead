<?php

namespace App\Repositories\Eloquent;

use App\Models\Course as Model;
use App\Repositories\CourseRepositoryInterface;

class CourseRepository implements CourseRepositoryInterface
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(string $filter = ''): array
    {
        $courses = $this->model
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('email', $filter);
                    $query->orWhere('name', 'LIKE', "%{$filter}%");
                }
            })
            ->get();
            
        return $courses->toArray(); // espera que retornemos um array
    }

    public function findById(string $id): object|null
    {
        return $this->model->find($id);
    }

    public function create(array $data): object
    {
        $course = $this->model->create($data);

        return $course;
    }

    public function update(string $id, array $data): object|null
    {
        if (!$course = $this->findById($id)) { // se não encontrar um usuário, retorna null
            return null;
        }

        $course->update($data);

        return $course;
    }

    public function delete(string $id): bool
    {
        if (!$course = $this->findById($id)) { // se não encontrar um curso, retorna null
            return false;
        }

        return $course->delete();
    }
}
