@extends("layouts.admin-layout")

@section("title", "contact Details: " . $contact->first_name . " " . $contact->last_name)

@section("content")
    <div class="w-full px-4">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 space-y-3 sm:space-y-0">
            <h1 class="text-2xl font-bold text-gray-800">
                <i class="fas fa-user-tie me-2"></i> contact Details
            </h1>

            <div class="flex space-x-2">
                
                <a href="{{ route("admin.contacts.index") }}"
                    class="bg-gray-700 text-white py-2 px-4 rounded-lg shadow hover:scale-105 transition-transform duration-200">
                    <i class="fas fa-arrow-left me-1"></i> Back to contacts
                </a>
            </div>
        </div>

        <!-- contact Info -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
            <div class="bg-gray-100 text-center py-3 border-b">
                <h5 class="m-0 font-semibold text-primary">
                    <i class="fas fa-info-circle me-2"></i> contact Information
                </h5>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div>
                    <h6 class="text-gray-500 mb-1">Email</h6>
                    <p>
                        @if ($contact->email)
                            <a href="" class="text-blue-600 hover:underline">
                                <i class="fas fa-envelope me-2"></i>{{ $contact->email }}
                            </a>
                        @else
                            <span class="text-gray-400">N/A</span>
                        @endif
                    </p>
                </div>

                <div class="md:col-span-2 lg:col-span-3">
                    <h6 class="text-gray-500 mb-1">message</h6>
                    <p class="font-medium text-gray-800 whitespace-pre-line">
                        {{ $contact->message ?? "No messages yet." }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    @push("scripts")
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(el => new bootstrap.Tooltip(el));
            });
        </script>
    @endpush
@endsection
