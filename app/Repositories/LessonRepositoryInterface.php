<?php

namespace App\Repositories;

interface LessonRepositoryInterface
{
    public function getAllByModuleId(string $moduleId, string $filter = ''): array;
    public function findById(string $id): ?object; // pode retornar um object ou null
    public function createByModule(string $moduleId, array $data): object;
    public function update(string $id, array $data): ?object; // retorna object ou null
    public function delete(string $id): bool;
}
