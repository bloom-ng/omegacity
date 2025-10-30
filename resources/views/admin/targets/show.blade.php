@extends("layouts.admin-layout")

@section("title", "{{ $agent->name }} - Targets & Progress")

@section("content")
    <div class="w-full">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $agent->name }} - Targets & Progress</h1>
                <p class="text-gray-600">{{ $currentYear }} Performance Overview</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.targets.create', $agent) }}"
                    class="bg-black shadow-md hover:scale-110 transition-transform duration-200 text-white font-medium py-2 px-4 rounded-lg">
                    <i class="fas fa-plus mr-2"></i> Set New Targets
                </a>
                <a href="{{ route('admin.targets.index') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Agents
                </a>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Current Month -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-md">
                        <i class="fas fa-calendar-alt text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">This Month</p>
                        <p class="text-2xl font-bold text-gray-900">
                            {{ \Carbon\Carbon::now()->format('M Y') }}
                        </p>
                    </div>
                </div>
                @if($summary['monthly']['amount_target'])
                    <div class="mt-4">
                        <div class="flex justify-between text-sm">
                            <span>Amount: {{ $summary['monthly']['amount_target']->formatted_achieved_value }}</span>
                            <span>{{ $summary['monthly']['amount_target']->progress_percentage }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ min(100, $summary['monthly']['amount_target']->progress_percentage) }}%"></div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Current Quarter -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-md">
                        <i class="fas fa-chart-line text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">This Quarter</p>
                        <p class="text-2xl font-bold text-gray-900">Q{{ $summary['current_quarter'] }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <p class="text-sm text-gray-600">Amount: ₦{{ number_format($summary['quarterly']['amount_achieved'], 0) }}</p>
                    <p class="text-sm text-gray-600">Sales: {{ $summary['quarterly']['sales_achieved'] }}</p>
                </div>
            </div>

            <!-- Year Progress -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-purple-100 rounded-md">
                        <i class="fas fa-trophy text-purple-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Year {{ $currentYear }}</p>
                        <p class="text-2xl font-bold text-gray-900">
                            @if($summary['yearly']['amount_target'])
                                {{ $summary['yearly']['amount_target']->progress_percentage }}%
                            @else
                                N/A
                            @endif
                        </p>
                    </div>
                </div>
                @if($summary['yearly']['amount_target'])
                    <div class="mt-4">
                        <div class="flex justify-between text-sm">
                            <span>Amount: {{ $summary['yearly']['amount_target']->formatted_achieved_value }}</span>
                            <span>Target: {{ $summary['yearly']['amount_target']->formatted_target_value }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: {{ min(100, $summary['yearly']['amount_target']->progress_percentage) }}%"></div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Assigned Clients -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-orange-100 rounded-md">
                        <i class="fas fa-users text-orange-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Assigned Clients</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $clientsCount }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <p class="text-sm text-gray-600">Total clients assigned to this agent</p>
                </div>
            </div>
        </div>

        <!-- Detailed Progress -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Monthly Progress -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Monthly Progress</h3>
                </div>
                <div class="p-6">
                    @if($summary['monthly']['amount_target'] || $summary['monthly']['sales_target'])
                        <div class="space-y-6">
                            @if($summary['monthly']['amount_target'])
                                <div>
                                    <h4 class="font-medium text-gray-900 mb-2">Amount Target</h4>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span>Progress</span>
                                        <span>{{ $summary['monthly']['amount_target']->formatted_achieved_value }} / {{ $summary['monthly']['amount_target']->formatted_target_value }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="bg-blue-600 h-3 rounded-full" style="width: {{ min(100, $summary['monthly']['amount_target']->progress_percentage) }}%"></div>
                                    </div>
                                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                                        <span>{{ $summary['monthly']['amount_target']->progress_percentage }}% Complete</span>
                                        <span class="@if($summary['monthly']['amount_target']->is_achieved) text-green-600 @else text-gray-500 @endif">
                                            @if($summary['monthly']['amount_target']->is_achieved) 
                                                <i class="fas fa-check-circle"></i> Achieved
                                            @else 
                                                Remaining: ₦{{ number_format($summary['monthly']['amount_target']->remaining, 0) }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @endif

                            @if($summary['monthly']['sales_target'])
                                <div>
                                    <h4 class="font-medium text-gray-900 mb-2">Sales Target</h4>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span>Progress</span>
                                        <span>{{ $summary['monthly']['sales_target']->achieved_value }} / {{ $summary['monthly']['sales_target']->target_value }} sales</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="bg-green-600 h-3 rounded-full" style="width: {{ min(100, $summary['monthly']['sales_target']->progress_percentage) }}%"></div>
                                    </div>
                                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                                        <span>{{ $summary['monthly']['sales_target']->progress_percentage }}% Complete</span>
                                        <span class="@if($summary['monthly']['sales_target']->is_achieved) text-green-600 @else text-gray-500 @endif">
                                            @if($summary['monthly']['sales_target']->is_achieved) 
                                                <i class="fas fa-check-circle"></i> Achieved
                                            @else 
                                                Remaining: {{ number_format($summary['monthly']['sales_target']->remaining, 0) }} sales
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-calendar-times text-gray-400 text-3xl mb-4"></i>
                            <p class="text-gray-500">No monthly targets set</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Yearly Progress -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Yearly Progress</h3>
                </div>
                <div class="p-6">
                    @if($summary['yearly']['amount_target'] || $summary['yearly']['sales_target'])
                        <div class="space-y-6">
                            @if($summary['yearly']['amount_target'])
                                <div>
                                    <h4 class="font-medium text-gray-900 mb-2">Amount Target</h4>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span>Progress</span>
                                        <span>{{ $summary['yearly']['amount_target']->formatted_achieved_value }} / {{ $summary['yearly']['amount_target']->formatted_target_value }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="bg-purple-600 h-3 rounded-full" style="width: {{ min(100, $summary['yearly']['amount_target']->progress_percentage) }}%"></div>
                                    </div>
                                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                                        <span>{{ $summary['yearly']['amount_target']->progress_percentage }}% Complete</span>
                                        <span class="@if($summary['yearly']['amount_target']->is_achieved) text-green-600 @else text-gray-500 @endif">
                                            @if($summary['yearly']['amount_target']->is_achieved) 
                                                <i class="fas fa-check-circle"></i> Achieved
                                            @else 
                                                Remaining: ₦{{ number_format($summary['yearly']['amount_target']->remaining, 0) }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @endif

                            @if($summary['yearly']['sales_target'])
                                <div>
                                    <h4 class="font-medium text-gray-900 mb-2">Sales Target</h4>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span>Progress</span>
                                        <span>{{ $summary['yearly']['sales_target']->achieved_value }} / {{ $summary['yearly']['sales_target']->target_value }} sales</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="bg-orange-600 h-3 rounded-full" style="width: {{ min(100, $summary['yearly']['sales_target']->progress_percentage) }}%"></div>
                                    </div>
                                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                                        <span>{{ $summary['yearly']['sales_target']->progress_percentage }}% Complete</span>
                                        <span class="@if($summary['yearly']['sales_target']->is_achieved) text-green-600 @else text-gray-500 @endif">
                                            @if($summary['yearly']['sales_target']->is_achieved) 
                                                <i class="fas fa-check-circle"></i> Achieved
                                            @else 
                                                Remaining: {{ number_format($summary['yearly']['sales_target']->remaining, 0) }} sales
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-calendar-times text-gray-400 text-3xl mb-4"></i>
                            <p class="text-gray-500">No yearly targets set</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- All Targets Table -->
        @if($targets->count() > 0)
            <div class="bg-white rounded-lg shadow">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">All Targets ({{ $currentYear }})</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Period</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Target</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Achieved</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($targets as $target)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        @if($target->period_type === 'monthly')
                                            {{ \Carbon\Carbon::create()->month($target->month)->format('M') }} {{ $target->year }}
                                        @else
                                            {{ $target->year }} (Yearly)
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            @if($target->target_type === 'amount') bg-blue-100 text-blue-800 @else bg-green-100 text-green-800 @endif">
                                            {{ ucfirst($target->target_type) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $target->formatted_target_value }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $target->formatted_achieved_value }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ min(100, $target->progress_percentage) }}%"></div>
                                            </div>
                                            <span class="text-sm text-gray-900">{{ $target->progress_percentage }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            @if($target->status === 'achieved') bg-green-100 text-green-800 
                                            @elseif($target->status === 'active') bg-blue-100 text-blue-800 
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst($target->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.targets.edit', [$agent, $target]) }}" 
                                                class="text-blue-600 hover:text-blue-900">Edit</a>
                                            <form method="POST" action="{{ route('admin.targets.destroy', [$agent, $target]) }}" 
                                                class="inline" onsubmit="return confirm('Are you sure you want to delete this target?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection
