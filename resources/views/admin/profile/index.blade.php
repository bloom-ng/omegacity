@extends("layouts.admin-layout")

@section("title", "Users")

@section("content")
    <div class="w-full">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">User Profile</h1>
            
        </div>


        <div class="bg-white rounded-lg shadow overflow-hidden">


            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Password</th>
                        <th class="py-3 px-6 text-center">Role</th>

                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ auth()->user()->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ auth()->user()->email }}
                            </td>
                             <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">

    {{-- Display Mode --}}
    <span id="passwordMask">********</span>

    {{-- Edit Button --}}
    <button onclick="enablePasswordEdit()" class="text-blue-600 ml-3">
        <i class="fas fa-edit"></i>
    </button>

    {{-- Edit Form (Hidden initially) --}}
    <form id="passwordForm" action="{{ route('admin.users.update-password', auth()->user()) }}" method="POST" class="hidden mt-2 flex items-center space-x-2">
        @csrf
        @method('PUT')

        <input type="password" name="password" required class="border rounded px-2 py-1 text-sm" placeholder="New Password">

        <button class="text-green-600 text-sm">
            <i class="fas fa-check"></i>
        </button>

        <button type="button" onclick="cancelPasswordEdit()" class="text-red-600 text-sm">
            <i class="fas fa-times"></i>
        </button>
    </form>
</td>

                            <td class="py-3 px-6 text-center">
                                {{ ucfirst(auth()->user()->role->name) }}
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <script>
function enablePasswordEdit() {
    document.getElementById('passwordMask').classList.add('hidden');
    document.getElementById('passwordForm').classList.remove('hidden');
}

function cancelPasswordEdit() {
    document.getElementById('passwordMask').classList.remove('hidden');
    document.getElementById('passwordForm').classList.add('hidden');
}
</script>

    @endsection
