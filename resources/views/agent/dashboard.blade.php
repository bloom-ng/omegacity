@extends("layouts.admin-layout")

@section("title", "Agent Dashboard - {{ $agent->name }}")

@section("content")
    <div class="w-full">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Welcome, {{ $agent->name }}</h1>
                <p class="text-gray-600">Your performance dashboard for {{ $currentYear }}</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('agent.clients.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                    <i class="fas fa-plus mr-2"></i> Add Client
                </a>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-md">
                        <i class="fas fa-users text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Clients</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_clients'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-md">
                        <i class="fas fa-map-marked text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Land Listings</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_land_listings'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-purple-100 rounded-md">
                        <i class="fas fa-calendar text-purple-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">This Month</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['clients_this_month'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-orange-100 rounded-md">
                        <i class="fas fa-handshake text-orange-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Prospects</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['prospects'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Targets Overview -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            <!-- Monthly Targets -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">This Month</h3>
                </div>
                <div class="p-6">
                    @if($summary['monthly']['amount_target'] || $summary['monthly']['sales_target'])
                        <div class="space-y-4">
                            @if($summary['monthly']['amount_target'])
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span>Amount Target</span>
                                        <span>{{ $summary['monthly']['amount_target']->progress_percentage }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-600 h-2 rounded-full" style="width: {{ min(100, $summary['monthly']['amount_target']->progress_percentage) }}%"></div>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">{{ $summary['monthly']['amount_target']->formatted_achieved_value }} / {{ $summary['monthly']['amount_target']->formatted_target_value }}</p>
                                </div>
                            @endif
                            @if($summary['monthly']['sales_target'])
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span>Sales Target</span>
                                        <span>{{ $summary['monthly']['sales_target']->progress_percentage }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-green-600 h-2 rounded-full" style="width: {{ min(100, $summary['monthly']['sales_target']->progress_percentage) }}%"></div>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">{{ $summary['monthly']['sales_target']->achieved_value }} / {{ $summary['monthly']['sales_target']->target_value }} sales</p>
                                </div>
                            @endif
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No monthly targets set</p>
                    @endif
                </div>
            </div>

            <!-- Quarterly Progress -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $summary['quarterly']['period_name'] }}</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Total Amount</p>
                            <p class="text-xl font-bold text-gray-900">₦{{ number_format($summary['quarterly']['amount_achieved'], 0) }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Total Sales</p>
                            <p class="text-xl font-bold text-gray-900">{{ $summary['quarterly']['sales_achieved'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Yearly Progress -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Year {{ $currentYear }}</h3>
                </div>
                <div class="p-6">
                    @if($summary['yearly']['amount_target'] || $summary['yearly']['sales_target'])
                        <div class="space-y-4">
                            @if($summary['yearly']['amount_target'])
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span>Amount Target</span>
                                        <span>{{ $summary['yearly']['amount_target']->progress_percentage }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-purple-600 h-2 rounded-full" style="width: {{ min(100, $summary['yearly']['amount_target']->progress_percentage) }}%"></div>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">{{ $summary['yearly']['amount_target']->formatted_achieved_value }} / {{ $summary['yearly']['amount_target']->formatted_target_value }}</p>
                                </div>
                            @endif
                            @if($summary['yearly']['sales_target'])
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span>Sales Target</span>
                                        <span>{{ $summary['yearly']['sales_target']->progress_percentage }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-orange-600 h-2 rounded-full" style="width: {{ min(100, $summary['yearly']['sales_target']->progress_percentage) }}%"></div>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">{{ $summary['yearly']['sales_target']->achieved_value }} / {{ $summary['yearly']['sales_target']->target_value }} sales</p>
                                </div>
                            @endif
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No yearly targets set</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Clients -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Clients</h3>
                    <a href="{{ route('agent.clients') }}" class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                        View All
                    </a>
                </div>
                <div class="divide-y divide-gray-200">
                    @forelse($recentClients as $client)
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900">{{ $client->full_name }}</h4>
                                    <p class="text-sm text-gray-500">{{ $client->email ?: $client->phone }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($client->status === 'prospect') bg-gray-100 text-gray-800 
                                        @elseif($client->status === 'contacted') bg-blue-100 text-blue-800 
                                        @elseif($client->status === 'interested') bg-yellow-100 text-yellow-800 
                                        @elseif($client->status === 'converted') bg-green-100 text-green-800 
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($client->status) }}
                                    </span>
                                    <p class="text-xs text-gray-500 mt-1">{{ $client->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center">
                            <i class="fas fa-users text-gray-400 text-2xl mb-2"></i>
                            <p class="text-gray-500">No clients yet</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Assigned Land Listings -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">My Land Listings</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    @forelse($assignedLandListings as $listing)
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900">{{ $listing->property_name }}</h4>
                                    <p class="text-sm text-gray-500">{{ $listing->location }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium text-gray-900">{{ $listing->formatted_price }}</p>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($listing->status === 'available') bg-green-100 text-green-800 
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($listing->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center">
                            <i class="fas fa-map text-gray-400 text-2xl mb-2"></i>
                            <p class="text-gray-500">No land listings assigned</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
