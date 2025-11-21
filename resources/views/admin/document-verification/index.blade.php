@extends("layouts.admin-layout")

@section("content")
    <div class="w-full flex justify-center mt-10">

        <div class="bg-white p-6 rounded-lg shadow w-full max-w-xl">

            {{-- Search Form --}}
            <form method="GET" action="{{ route("admin.documents-verification.index") }}" class="relative w-full">
                <input type="text" name="search" value="{{ request("search") }}"
                    class="form-input w-full pl-10 pr-4 py-2 border rounded-lg" placeholder="Search by document number">

                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 6 0 012 8z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </form>

            @if (request("search"))
                <div class="flex justify-between items-center mt-3">
                    <a href="{{ route("admin.documents-verification.index") }}"
                        class="bg-black shadow-md hover:scale-110 transition-transform duration-200 text-white text-sm font-medium py-2 px-4 rounded-lg">
                        Clear
                    </a>
                </div>

                {{-- Document Verification Message --}}
                <div class="mt-6">
                    @if (count($invoices) > 0 || count($receipts) > 0)
                        <div class="flex flex-col items-center justify-center text-center p-4">

                            <!-- Top Image -->
                            <img src="{{ asset("assets/images/Omega-City.png") }}" alt="Document Image" class="w-24 h-24 object-cover mb-4">

                            <!-- Message -->
                            <p class="font-semibold text-lg">
                                This document is AUTHENTIC and VERIFIED.
                            </p>

                            <div class="mt-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="green" class="w-10 h-10">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                            </div>

                        </div>
                    @else
                        <p class="text-red-700 font-semibold text-lg text-center">
                            This document is NOT verified.❌ ❌
                        </p>
                    @endif
                </div>
            @endif

        </div>

    </div>
@endsection
