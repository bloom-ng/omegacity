@extends("layouts.admin-layout")

@section("title", "Edit User")

@section("content")
    <div class="w-full">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Edit User: {{ $user->name }}</h1>
            <a href="{{ route("admin.users.index") }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                <span class="flex items-center">
                    <span class="mr-1">←</span> Back to Users
                </span>
            </a>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-8">
                <form action="{{ route("admin.users.update", $user) }}" method="POST">
                    @csrf
                    @method("PUT")

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Name</label>
                        <input type="text" name="name" id="name" value="{{ old("name", $user->name) }}" required
                            class="py-3 px-2 shadow-md focus:ring-black focus:border-black block w-full sm:text-sm text-sm border-gray-300 rounded-md @error("name") border-red-500 @enderror">
                        @error("name")
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                     <div class="mb-4">
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ old("phone", $user->phone) }}" required
                            class="py-3 px-2 shadow-md focus:ring-black focus:border-black block w-full sm:text-sm text-sm border-gray-300 rounded-md @error("phone") border-red-500 @enderror">
                        @error("phone")
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email</label>
                        <input type="email" name="email" id="email" value="{{ old("email", $user->email) }}"
                            required
                            class="py-3 px-2 shadow-md focus:ring-black focus:border-black block w-full sm:text-sm text-sm border-gray-300 rounded-md @error("email") border-red-500 @enderror">
                        @error("email")
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">New Password (leave
                            blank
                            to
                            keep current)</label>
                        <input type="password" name="password" id="password"
                            class="py-3 px-2 shadow-md focus:ring-black focus:border-black block w-full sm:text-sm text-sm border-gray-300 rounded-md @error("password") border-red-500 @enderror">
                        @error("password")
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-gray-700 text-sm font-semibold mb-2">Confirm
                            New
                            Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="py-3 px-2 shadow-md focus:ring-black focus:border-black block w-full sm:text-sm text-sm border-gray-300 rounded-md">
                    </div>

                    <div class="mb-6">
                        <label for="role_id" class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                        <select name="role_id" id="role_id" required
                            class="py-3 px-2 shadow-md focus:ring-black focus:border-black block w-full sm:text-sm text-sm border-gray-300 rounded-md @error("role_id") border-red-500 @enderror">
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ old("role_id", $user->role_id) == $role->id ? "selected" : "" }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                        @error("role_id")
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="flex items-center mt-12">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-black hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white">
                            Update User
                        </button>


                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
