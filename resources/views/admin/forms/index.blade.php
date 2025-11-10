@extends("layouts.admin-layout")

@section("content")
<div class="w-full flex justify-center mt-10">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

        {{-- Expression of Interest Card --}}
        <a href="{{ route('admin.forms.eoi') }}" class="block bg-white rounded-lg shadow hover:shadow-lg transform hover:scale-105 transition-transform duration-200 p-6 text-center">
            <div class="text-4xl mb-4 text-blue-600">
                <i class="fas fa-file-alt"></i>
            </div>
            <h2 class="text-xl font-semibold text-gray-800">Expression of Interest (EOI)</h2>
        </a>

        {{-- Guarantors Card --}}
        <a href="{{ route('admin.forms.guarantor') }}" class="block bg-white rounded-lg shadow hover:shadow-lg transform hover:scale-105 transition-transform duration-200 p-6 text-center">
            <div class="text-4xl mb-4 text-green-600">
                <i class="fas fa-users"></i>
            </div>
            <h2 class="text-xl font-semibold text-gray-800">Guarantors</h2>
        </a>

        {{-- Sale Tracking Card --}}
        <a href="" class="block bg-white rounded-lg shadow hover:shadow-lg transform hover:scale-105 transition-transform duration-200 p-6 text-center">
            <div class="text-4xl mb-4 text-red-600">
                <i class="fas fa-chart-line"></i>
            </div>
            <h2 class="text-xl font-semibold text-gray-800">Sale Tracking</h2>
        </a>

    </div>
</div>
@endsection
