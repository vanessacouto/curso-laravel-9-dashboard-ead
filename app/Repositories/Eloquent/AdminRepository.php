<?php

namespace App\Repositories\Eloquent;

use App\Models\Admin as Model;
use App\Repositories\AdminRepositoryInterface;

class AdminRepository implements AdminRepositoryInterface
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(string $filter = ''): array
    {
        $admins = $this->model
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('email', $filter);
                    $query->orWhere('name', 'LIKE', "%{$filter}%");
                }
            })
            ->get();
            
        return $admins->toArray(); // espera que retornemos um array
    }

    public function findById(string $id): object|null
    {
        return $this->model->find($id);
    }

    public function create(array $data): object
    {
        $admin = $this->model->create($data);

        return $admin;
    }

    public function update(string $id, array $data): object|null
    {
        if (!$admin = $this->findById($id)) { // se não encontrar um usuário, retorna null
            return null;
        }

        $admin->update($data);

        return $admin;
    }

    public function delete(string $id): bool
    {
        if (!$admin = $this->findById($id)) { // se não encontrar um usuário, retorna null
            return false;
        }

        return $admin->delete();
    }
}
