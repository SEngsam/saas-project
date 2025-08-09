<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use Exception;

class UserRepository
{
    public function all()
    {
        return User::latest()->paginate(10);
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function create(array $data)
    {
        try {
            return User::create($data);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function update($id, array $data)
    {
        try {
            $user = $this->find($id);
            $user->update($data);
            return $user;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function delete($id)
    {
        return User::destroy($id);
    }
}
