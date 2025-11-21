@extends("layouts.admin-layout")

@section("title", "Agent Targets Management")

@section("content")
    <div class="w-full">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Marketer Targets Management</h1>
            <div class="flex space-x-3">
                <form method="POST" action="{{ route("admin.targets.refresh") }}" class="inline">
                    @csrf
                    <button type="submit"
                        class="bg-black shadow-md hover:scale-110 transition-transform duration-200 text-white font-medium py-2 px-4 rounded-lg">
                        <i class="fas fa-sync-alt mr-2"></i> Refresh Progress
                    </button>
                </form>
            </div>
        </div>

        @if ($agents->count() > 0)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <form method="GET" action="{{ route("admin.targets.index") }}" class="relative max-w-xs w-full">
                            <input type="text" name="search" value="{{ request("search") }}"
                                class="form-input w-full pl-10 pr-4 py-2 border rounded-lg" placeholder="Search agents...">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </form>
                        @if (request("search"))
                            <a href="{{ route("admin.targets.index") }}" class="text-sm text-blue-600 hover:underline">
                                Clear
                            </a>
                        @endif
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <tr>
                                <th class="py-3 px-6 text-left">
                                    Marketer
                                </th>
                                <th class="py-3 px-6 text-left">
                                    Email
                                </th>
                                <th class="py-3 px-6 text-left">
                                    Active Targets ({{ now()->year }})
                                </th>
                                <th class="py-3 px-6 text-left">
                                    Assigned Clients
                                </th>
                                <th class="py-3 px-6 text-left">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($agents as $agent)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <div class="flex items-center">

                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ $agent->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="text-sm text-gray-900">{{ $agent->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="text-sm text-gray-900">
                                            @if ($agent->agentTargets->count() > 0)
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach ($agent->agentTargets as $target)
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                            @if ($target->status === "achieved") bg-green-100 text-green-800
                                                            @elseif($target->status === "active") bg-blue-100 text-blue-800
                                                            @else bg-gray-100 text-gray-800 @endif">
                                                            {{ ucfirst($target->period_type) }}
                                                            {{ ucfirst($target->target_type) }}
                                                            @if ($target->status === "achieved")
                                                                ✓
                                                            @endif
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="text-gray-400 text-sm">No targets set</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <span class="text-sm text-gray-900">{{ $agent->assignedClients()->count() }}
                                            clients</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex space-x-4">
                                            <a href="{{ route("admin.targets.show", $agent) }}"
                                                class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-eye"></i> View Progress
                                            </a>
                                            <a href="{{ route("admin.targets.create", $agent) }}"
                                                class="text-gray-800 hover:text-gray-900">
                                                <i class="fas fa-plus"></i> Set Targets
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $agents->appends(request()->query())->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <i class="fas fa-users text-gray-400 text-4xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No Agents Found</h3>
                <p class="text-gray-500 mb-4">There are no users with the Agent role. Please create agents first.</p>

            </div>
        @endif
    </div>
@endsection
