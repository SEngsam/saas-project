<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function find(int $id)
    {
        return User::find($id);
    }

    public function all()
    {
        return User::all();
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(int $id, array $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }
}
