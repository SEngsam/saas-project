<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use Inertia\Inertia;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();

        return Inertia::render('Admin/Users/Index', [
            'users' => $users
        ]);
    }

public function create()
{


    return Inertia::render('Admin/Users/Create', [

    ]);
}
    public function show($id)
    {
        $user = $this->userService->getUserById($id);

        return Inertia::render('Admin/Users/Edit', [
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|string',
            'username' => 'nullable|string|unique:users',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string',
            'gender' => 'nullable|in:male,female,other',
            'birthday' => 'nullable|date',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'address' => 'nullable|string',
            'country' => 'nullable|string',
            'status' => 'in:active,inactive,banned',
            'password' => 'required|string|min:6',
        ]);

        $data['password'] = bcrypt($data['password']);

        $this->userService->createUser($data);

        return redirect()->route('admin.users.index')->with('success', 'User created.');
    }
    public function update(Request $request, User $user)
    {

        $data = $request->validate([
            'name' => 'required|string',
            'username' => 'nullable|string|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string',
            'gender' => 'nullable|in:male,female,other',
            'birthday' => 'nullable|date',
            'avatar' => 'nullable|string',
            'address' => 'nullable|string',
            'country' => 'nullable|string',
            'status' => 'in:active,inactive,banned',

        ]);

        $this->userService->updateUser($user->id, $data);

        return redirect()->route('admin.users.index')->with('success', 'User updated.');
    }

    public function destroy($id)
    {
        $this->userService->deleteUser($id);

        return redirect()->back()->with('success', 'User deleted.');
    }
}
