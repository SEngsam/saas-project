<?php
namespace App\Repositories;

interface UserRepositoryInterface
{
    public function find(int $id);
    public function all();
    public function create(array $data);
    public function update(int $id, array $data);
}
