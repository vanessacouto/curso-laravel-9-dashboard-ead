<?php

namespace App\Repositories\Eloquent;

use App\Models\Lesson as Model;
use App\Repositories\LessonRepositoryInterface;

class LessonRepository implements LessonRepositoryInterface
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAllByModuleId(string $moduleId, string $filter = ''): array
    {
        $lessons = $this->model
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->orWhere('name', 'LIKE', "%{$filter}%");
                }
            })
            ->where('module_id', $moduleId)
            ->with('module')
            ->get();
            
        return $lessons->toArray(); // espera que retornemos um array
    }

    public function findById(string $id): object|null
    {
        return $this->model->find($id);
    }

    public function createByModule(string $moduleId, array $data): object
    {
        $data['module_id'] = $moduleId;
        $lesson = $this->model->create($data);

        return $lesson;
    }

    public function update(string $id, array $data): object|null
    {
        if (!$lesson = $this->findById($id)) { // se não encontrar um usuário, retorna null
            return null;
        }

        $lesson->update($data);

        return $lesson;
    }

    public function delete(string $id): bool
    {
        if (!$lesson = $this->findById($id)) { // se não encontrar a aula, retorna null
            return false;
        }

        return $lesson->delete();
    }
}
