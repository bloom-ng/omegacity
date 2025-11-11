@php
    function growthValue($current, $last)
    {
        if ($last == 0) {
            return $current > 0 ? 100 : 0;
        }
        return (($current - $last) / $last) * 100;
    }

    function growthPercent($current, $last)
    {
        $val = growthValue($current, $last);
        return ($val >= 0 ? "+" : "") . number_format($val, 1) . "%";
    }
@endphp

@extends("layouts.admin-layout")
@section("content")
    <div class="container mx-auto px-4 py-4">

        <h2 class="text-2xl font-bold text-gray-700 mb-2">Admin Dashboard</h2>

        {{-- STAT CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">

            @foreach (["contacts" => "blue", "clients" => "green", "land_listings" => "yellow", "invoices" => "purple", "receipts" => "red"] as $key => $color)
                @php
                    $data = $stats[$key];
                    $growth = growthValue($data["monthly"], $data["last_month"]);
                @endphp

                <div class="bg-white rounded-xl shadow p-6 border-l-4 border-none">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm font-medium text-gray-500 capitalize">{{ str_replace("_", " ", $key) }}</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $data["count"] }}</p>

                            <p class="text-xs mt-1 {{ $growth >= 0 ? "text-green-600" : "text-red-600" }}">
                                {{ growthPercent($data["monthly"], $data["last_month"]) }} from last month
                            </p>
                        </div>
                        <div class="flex flex-col items-center text-center">

                            @if ($key === "contacts")
                                <a href="{{ route("admin.contacts.index") }}"
                                    class="text-xs font-medium text-blue-600 hover:underline">
                                    <i class="fa-solid fa-eye"></i>
                                    Contacts
                                </a>
                            @elseif ($key === "clients")
                                <a href="{{ route("admin.users.create") }}"
                                    class="text-xs font-medium text-green-600 hover:underline">
                                   <i class="fa-solid fa-plus"></i>
                                   Clients
                                </a>
                            @elseif ($key === "land_listings")
                                <a href="{{ route("admin.landlistings.create") }}"
                                    class="text-xs font-medium text-yellow-600 hover:underline">
                                   <i class="fa-solid fa-plus"></i>
                                   Land-listing
                                </a>
                            @elseif ($key === "invoices")
                                <a href="{{ route("admin.invoices.create") }}"
                                    class="text-xs font-medium text-purple-600 hover:underline">
                                   <i class="fa-solid fa-plus"></i>
                                   Invoice
                                </a>
                            @elseif ($key === "receipts")
                                <a href="{{ route("admin.receipts.create") }}"
                                    class="text-xs font-medium text-red-600 hover:underline">
                                  <i class="fa-solid fa-plus"></i>
                                  Receipt
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- RECENT ACTIVITIES + QUICK LINKS --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">

            {{-- RECENT ACTIVITIES --}}
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b text-center">
                    <h2 class="text-lg font-semibold">Recent Activities</h2>
                </div>

                <div class="divide-y">
                    @forelse ($activities as $item)
                        <div class="p-4 hover:bg-gray-50">
                            <div class="flex items-start">
                                <div class="h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg class="h-6 w-7 text-blue-600" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>

                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">{{ $item["type"] }} — {{ $item["name"] }}
                                    </p>
                                    <p class="text-sm text-gray-500">{{ $item["details"] ?? " " }}</p>
                                    <p class="text-xs text-gray-400 mt-1">{{ $item["time"]->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-gray-500">No recent activities found</div>
                    @endforelse
                    {{-- <div class="mt-3">
    {{ $activities->links() }}
</div> --}}
                </div>
            </div>

            {{-- QUICK ACTIONS --}}
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b text-center">
                    <h2 class="text-lg font-semibold">Charts</h2>
                </div>

                <div class="p-4 space-y-2">


                </div>
            </div>

        </div>
    </div>
@endsection
