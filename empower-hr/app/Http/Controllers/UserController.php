<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // 1. List users
public function indexView()
{
    $users = User::orderBy('username')->paginate(10);
    return view('admin.users.index', compact('users'));
}

// 2. Show “Create User” form
public function createView()
{
    $roles = ['System Administrator','HR Manager','Department Manager','Employee'];
    return view('admin.users.create', compact('roles'));
}

// 3. Handle Create form submission
public function storeView(Request $request)
{
    $data = $request->validate([
        'username'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users',
        'password' => 'required|string|min:6|confirmed',
        'role'     => ['required', Rule::in(['System Administrator','HR Manager','Department Manager','Employee'])],
    ]);

    $data['password'] = Hash::make($data['password']);
    User::create($data);

    return redirect()->route('admin.users.index')
                     ->with('success', 'User created successfully.');
}

// 4. Show “Edit User” form
public function editView(User $user)
{
    $roles = ['System Administrator','HR Manager','Department Manager','Employee'];
    return view('admin.users.edit', compact('user','roles'));
}

// 5. Handle Edit form submission
public function updateView(Request $request, User $user)
{
    $data = $request->validate([
        'username'  => 'required|string|max:255',
        'email' => ['required','email', Rule::unique('users')->ignore($user->id)],
        'password' => 'nullable|string|min:6|confirmed',
        'role'  => ['required', Rule::in(['System Administrator','HR Manager','Department Manager','Employee'])],
    ]);

    if ($data['password'] ?? false) {
        $data['password'] = Hash::make($data['password']);
    } else {
        unset($data['password']);
    }

    $user->update($data);

    return redirect()->route('admin.users.index')
                     ->with('success', 'User updated successfully.');
}

// 6. Delete a user
public function destroyView(User $user)
{
    $user->delete();
    return redirect()->route('admin.users.index')
                     ->with('success', 'User deleted.');
}
    // List all users (you may restrict this with middleware)
    public function index()
    {
        return response()->json(User::all());
    }

    // Create a new user
    public function store(Request $request)
    {
        $request->validate([
            'username'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:HR Manager,Department Manager,Employee,System Administrator',
        ]);

        $user = User::create([
            'username'     => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return response()->json($user, 201);
    }

    // Show a specific user
    public function show($id)
    {
        return response()->json(User::findOrFail($id));
    }

    // Update a user account
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->only(['username', 'email', 'role']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return response()->json($user);
    }

    // Delete a user account
    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(null, 204);
    }
}
