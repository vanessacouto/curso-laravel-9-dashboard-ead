<?php

namespace App\Repositories\Eloquent;

use App\Models\Module as Model;
use App\Repositories\ModuleRepositoryInterface;

class ModuleRepository implements ModuleRepositoryInterface
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAllByCourseId(string $courseId, string $filter = ''): array
    {
        $modules = $this->model
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->orWhere('name', 'LIKE', "%{$filter}%");
                }
            })
            ->where('course_id', $courseId)
            ->with('course')
            ->get();
            
        return $modules->toArray(); // espera que retornemos um array
    }

    public function findById(string $id): object|null
    {
        return $this->model->find($id);
    }

    public function createByCourse(string $courseId, array $data): object
    {
        $data['course_id'] = $courseId;
        $module = $this->model->create($data);

        return $module;
    }

    public function update(string $id, array $data): object|null
    {
        if (!$module = $this->findById($id)) { // se não encontrar um usuário, retorna null
            return null;
        }

        $module->update($data);

        return $module;
    }

    public function delete(string $id): bool
    {
        if (!$module = $this->findById($id)) { // se não encontrar um curso, retorna null
            return false;
        }

        return $module->delete();
    }
}
