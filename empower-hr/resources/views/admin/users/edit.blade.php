@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
  <h1 class="text-2xl font-bold mb-4">Edit {{ $user->name }}</h1>

  <form action="{{ route('admin.users.update', $user) }}" method="POST" class="bg-white p-6 rounded shadow">
    @csrf @method('PUT')

    <div class="mb-4">
      <label class="block mb-1">Name</label>
      <input type="text" name="name" value="{{ old('name', $user->name) }}"
             class="w-full border p-2 rounded">
      @error('name') <div class="text-red-600">{{ $message }}</div> @enderror
    </div>

    <div class="mb-4">
      <label class="block mb-1">Email</label>
      <input type="email" name="email" value="{{ old('email', $user->email) }}"
             class="w-full border p-2 rounded">
      @error('email') <div class="text-red-600">{{ $message }}</div> @enderror
    </div>

    <div class="mb-4">
      <label class="block mb-1">Role</label>
      <select name="role" class="w-full border p-2 rounded">
        @foreach($roles as $role)
          <option value="{{ $role }}"
                  {{ old('role', $user->role)==$role ? 'selected':'' }}>
            {{ $role }}
          </option>
        @endforeach
      </select>
      @error('role') <div class="text-red-600">{{ $message }}</div> @enderror
    </div>

    <div class="mb-4">
      <label class="block mb-1">New Password <small>(leave blank to keep)</small></label>
      <input type="password" name="password" class="w-full border p-2 rounded">
      @error('password') <div class="text-red-600">{{ $message }}</div> @enderror
    </div>

    <div class="mb-4">
      <label class="block mb-1">Confirm Password</label>
      <input type="password" name="password_confirmation"
             class="w-full border p-2 rounded">
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
      Update
    </button>
    <a href="{{ route('admin.users.index') }}" class="ml-4 text-gray-600">Cancel</a>
  </form>
@endsection
