<?php

namespace App\Services;

use stdClass;
use App\Repositories\UserRepositoryInterface;

class UserService
{
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(string $filter = ''): array {
        $users = $this->repository->getAll($filter);
        $users = array_map(function ($data) {
            // converte pra um stdclass
            $stdClass = new stdClass;
            foreach($data as $key => $value) {
                $stdClass->{$key} = $value;
            }
            return $stdClass; // agora temos um objeto genérico, não mais um array
        }, $users);

        return $users;
        // return $this->repository->getAll($filter);
        
        //return collect($users); // converte o resultado para uma Collection
    }

    public function findById(string $id): object|null {
        return $this->repository->findById($id);
    }

    public function create(array $data): object {
       return $this->repository->create($data);
    }

    public function update(string $id, array $data): object|null {
        return $this->repository->update($id, $data);
    }

    public function delete(string $id): bool {
        return $this->repository->delete($id);
     }
}
