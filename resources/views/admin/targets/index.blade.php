@extends("layouts.admin-layout")

@section("title", "Agent Targets Management")

@section("content")
    <div class="w-full">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Agent Targets Management</h1>
            <div class="flex space-x-3">
                <form method="POST" action="{{ route('admin.targets.refresh') }}" class="inline">
                    @csrf
                    <button type="submit"
                        class="bg-black shadow-md hover:scale-110 transition-transform duration-200 text-white font-medium py-2 px-4 rounded-lg">
                        <i class="fas fa-sync-alt mr-2"></i> Refresh Progress
                    </button>
                </form>
            </div>
        </div>

        @if($agents->count() > 0)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Agent
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Active Targets ({{ now()->year }})
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Assigned Clients
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($agents as $agent)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-black rounded-full flex items-center justify-center">
                                                <span class="text-white font-semibold">
                                                    {{ strtoupper(substr($agent->name, 0, 2)) }}
                                                </span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $agent->name }}</div>
                                                <div class="text-sm text-gray-500">Agent</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $agent->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            @if($agent->agentTargets->count() > 0)
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach($agent->agentTargets as $target)
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                            @if($target->status === 'achieved') bg-green-100 text-green-800 
                                                            @elseif($target->status === 'active') bg-blue-100 text-blue-800 
                                                            @else bg-gray-100 text-gray-800 @endif">
                                                            {{ ucfirst($target->period_type) }} {{ ucfirst($target->target_type) }}
                                                            @if($target->status === 'achieved') ✓ @endif
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="text-gray-400 text-sm">No targets set</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-900">{{ $agent->assignedClients()->count() }} clients</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.targets.show', $agent) }}"
                                                class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-eye"></i> View Progress
                                            </a>
                                            <a href="{{ route('admin.targets.create', $agent) }}"
                                                class="text-green-600 hover:text-green-900">
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
                {{ $agents->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <i class="fas fa-users text-gray-400 text-4xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No Agents Found</h3>
                <p class="text-gray-500 mb-4">There are no users with the Agent role. Please create agents first.</p>
                <a href="{{ route('admin.users.create') }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-black hover:bg-gray-700">
                    <i class="fas fa-plus mr-2"></i> Create Agent
                </a>
            </div>
        @endif
    </div>
@endsection
