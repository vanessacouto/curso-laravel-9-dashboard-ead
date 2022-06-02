<?php

namespace App\Repositories;

interface ModuleRepositoryInterface
{
    public function getAllByCourseId(string $courseId, string $filter = ''): array;
    public function findById(string $id): ?object; // pode retornar um object ou null
    public function createByCourse(string $courseId, array $data): object;
    public function update(string $id, array $data): ?object; // retorna object ou null
    public function delete(string $id): bool;
}
