@extends('layouts.app')

@section('title', 'New User')

@section('content')
  <h1 class="text-2xl font-bold mb-4">Create User</h1>

  <form action="{{ route('admin.users.store') }}" method="POST" class="bg-white p-6 rounded shadow">
    @csrf

    <div class="mb-4">
      <label class="block mb-1">Name</label>
      <input type="text" name="name" value="{{ old('name') }}"
             class="w-full border p-2 rounded">
      @error('name') <div class="text-red-600">{{ $message }}</div> @enderror
    </div>

    <div class="mb-4">
      <label class="block mb-1">Email</label>
      <input type="email" name="email" value="{{ old('email') }}"
             class="w-full border p-2 rounded">
      @error('email') <div class="text-red-600">{{ $message }}</div> @enderror
    </div>

    <div class="mb-4">
      <label class="block mb-1">Role</label>
      <select name="role" class="w-full border p-2 rounded">
        @foreach($roles as $role)
          <option value="{{ $role }}" {{ old('role')==$role ? 'selected':'' }}>
            {{ $role }}
          </option>
        @endforeach
      </select>
      @error('role') <div class="text-red-600">{{ $message }}</div> @enderror
    </div>

    <div class="mb-4">
      <label class="block mb-1">Password</label>
      <input type="password" name="password" class="w-full border p-2 rounded">
      @error('password') <div class="text-red-600">{{ $message }}</div> @enderror
    </div>

    <div class="mb-4">
      <label class="block mb-1">Confirm Password</label>
      <input type="password" name="password_confirmation"
             class="w-full border p-2 rounded">
    </div>

    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
      Create
    </button>
    <a href="{{ route('admin.users.index') }}" class="ml-4 text-gray-600">Cancel</a>
  </form>
@endsection
