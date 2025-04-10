@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
  <div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Users</h1>
    <a href="{{ route('admin.users.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded">New User</a>
  </div>

  <table class="min-w-full bg-white shadow rounded">
    <thead>
      <tr>
        <th class="px-4 py-2">Name</th>
        <th class="px-4 py-2">Email</th>
        <th class="px-4 py-2">Role</th>
        <th class="px-4 py-2">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr class="border-t">
        <td class="px-4 py-2">{{ $user->name }}</td>
        <td class="px-4 py-2">{{ $user->email }}</td>
        <td class="px-4 py-2">{{ $user->role }}</td>
        <td class="px-4 py-2 space-x-2">
          <a href="{{ route('admin.users.edit', $user) }}"
             class="text-blue-600">Edit</a>
          <form action="{{ route('admin.users.destroy', $user) }}"
                method="POST" class="inline"
                onsubmit="return confirm('Delete this user?');">
            @csrf @method('DELETE')
            <button type="submit" class="text-red-600">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <div class="mt-4">
    {{ $users->links() }}
  </div>
@endsection
