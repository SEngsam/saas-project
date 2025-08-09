<?php

namespace App\Services;

use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getAllUsers()
    {
        return $this->userRepo->all();
    }
    public function getUserById($id)
    {
        return $this->userRepo->find($id);
    }

    public function createUser($data)
    {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepo->create($data);
    }

    public function updateUser($id, $data)
    {
        if (isset($data['password']) && $data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        return $this->userRepo->update($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->userRepo->delete($id);
    }
}
