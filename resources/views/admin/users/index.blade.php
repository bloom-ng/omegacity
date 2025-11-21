@extends("layouts.admin-layout")

@section("title", "Users")

@section("content")
    <div class="w-full">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Users Management</h1>
            <a href="{{ route("admin.users.create") }}"
                class="bg-black shadow-md hover:scale-110 transition-transform duration-200 text-white font-medium py-2 px-4 rounded-lg">
                <i class="fas fa-plus"></i>
                Create New User
            </a>
        </div>


        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex flex-col md:flex-row md:items-center md:justify-between">
                <form method="GET" action="{{ route("admin.users.index") }}" class="relative max-w-xs w-full">
                    <input type="text" name="search" value="{{ request("search") }}"
                        class="form-input w-full pl-10 pr-4 py-2 border rounded-lg"
                        placeholder="Search users by name, email or role...">

                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Phone</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-center">Role</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @foreach ($users as $user)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $user->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $user->phone }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900s">
                                    {{ $user->email }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    @php
                                        $roleName = strtolower($user->role->name ?? "");
                                        $roleColors = [
                                            "accountant" => "bg-red-200 text-red-600",
                                            "agent" => "bg-green-200 text-green-600",
                                            "admin" => "bg-blue-200 text-blue-600",
                                        ];
                                        $colorClass = $roleColors[$roleName] ?? "bg-yellow-200 text-yellow-600";
                                    @endphp

                                    <span class="{{ $colorClass }} py-1 px-3 rounded-full text-xs font-semibold">
                                        {{ ucfirst($user->role->name) }}
                                    </span>
                                </td>

                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <a href="{{ route("admin.users.edit", $user) }}"
                                            class="w-4 mr-2 transform text-indigo-600 hover:text-indigo-900 hover:scale-110">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route("admin.users.destroy", $user) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit"
                                                class="w-4 mr-2 transform text-red-600 hover:text-red-900 hover:scale-110"
                                                onclick="return confirm('Are you sure you want to delete this user?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    @endsection
