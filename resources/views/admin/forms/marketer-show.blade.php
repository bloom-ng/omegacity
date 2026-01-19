@extends("layouts.admin-layout")

@section("content")
    <div class="w-full px-4">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Marketer Profile
                </h1>
                <div class="text-sm text-gray-500 mt-1">
                    Joined on {{ $marketer->created_at->format("M d, Y") }}
                </div>
            </div>

            <div class="flex space-x-2">
                <a href="{{ route("admin.forms.marketer") }}"
                    class="bg-gray-700 text-white py-2 px-4 rounded-lg shadow hover:scale-105 transition-transform duration-200">
                    <i class="fas fa-arrow-left me-1"></i> Back to Marketers
                </a>
            </div>
        </div>

        {{-- Marketer Info --}}
        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ $marketer->full_name }} <br>

                    @if ($marketer->passport)
                        <img src="{{ asset("storage/" . $marketer->passport) }}" alt="Marketer Passport"
                            class="mt-2 h-24 object-contain border rounded bg-white p-2">
                    @endif
                </h3>
            </div>

            <div class="px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Personal Details</h4>
                        <div class="mt-2 text-sm font-bold text-gray-900 space-y-1">
                            <p>Email: {{ $marketer->email }}</p>
                            <p>Phone: {{ $marketer->phone }}</p>
                            <p>Gender: {{ $marketer->gender }}</p>
                            <p>Date of Birth: {{ $marketer->dob->format("M d, Y") }}</p>
                            <p>Occupation: {{ $marketer->occupation }}</p>
                            <p>Address: {{ $marketer->address }}</p>
                        </div>
                        <div>
                            <h3 class="text-l font-medium text-gray-500 mt-6">Signature</h4>

                                @if ($marketer->signature)
                                    <img src="{{ asset("storage/" . $marketer->signature) }}" alt="Marketer Signature"
                                        class="mt-2 h-24 object-contain border rounded bg-white p-2">
                                @else
                                    <p class="mt-2 text-sm text-gray-400">No signature uploaded</p>
                                @endif
                        </div>
                    </div>

                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Bank Details</h4>
                        <div class="mt-2 text-sm font-bold text-gray-900 space-y-1">
                            <p>Account Number: {{ $marketer->account_number }}</p>
                            <p>Bank Name: {{ $marketer->bank_name }}</p>
                            <p>Account Name: {{ $marketer->account_name }}</p>
                        </div>

                        <div class="mt-5 text-sm font-bold text-gray-900 space-y-1">
                            <h4 class="text-gray-500">Name of Contact Staff</h4>
                            @if ($marketer->contact_staff)
                                <p>{{ $marketer->contact_staff }}</p>
                            @else
                                <p class="mt-2 text-sm text-gray-400">No Contact Staff</p>
                            @endif
                        </div>

                        <div>
                            <h3 class="text-l font-bold text-gray-500 mt-4">Means of Identification :</h3>

                            @if ($marketer->id_file)
                                <p class="font-bold">{{ $marketer->id_type }}</p>
                                <img src="{{ asset("storage/" . $marketer->id_file) }}" alt="Marketer ID"
                                    class="mt-2 h-24 object-contain border rounded bg-white p-2">
                            @else
                                <p class="mt-2 text-sm text-gray-400">No means of identification</p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
