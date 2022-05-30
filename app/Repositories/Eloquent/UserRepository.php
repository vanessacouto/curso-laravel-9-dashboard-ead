<?php

namespace App\Repositories\Eloquent;

use App\Models\User as Model;
use App\Repositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(string $filter = ''): array
    {
        // $users = $this->model->paginate(); // o paginate já retorna os dados paginados
        $users = $this->model
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('email', $filter);
                    $query->orWhere('name', 'LIKE', "%{$filter}%");
                }
            })
            ->get();
        return $users->toArray(); // espera que retornemos um array
    }

    public function findById(string $id): object|null
    {
        return $this->model->find($id);
    }

    public function create(array $data): object
    {
        $user = $this->model->create($data);

        return $user;
    }

    public function update(string $id, array $data): object|null
    {
        if (!$user = $this->findById($id)) { // se não encontrar um usuário, retorna null
            return null;
        }

        $user->update($data);

        return $user;
    }

    public function delete(string $id): bool
    {
        if (!$user = $this->findById($id)) { // se não encontrar um usuário, retorna null
            return false;
        }

        return $user->delete();
    }
}
