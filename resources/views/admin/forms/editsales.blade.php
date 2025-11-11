@extends("layouts.admin-layout")

@section("content")
<div class="max-w-5xl mx-auto mt-8 space-y-8">

    {{-- CLIENT INFORMATION (Read-only) --}}
    <div class="section-card">
        <h3 class="section-title">Client Information</h3>
        <hr class="mb-4">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label>Full Name</label>
                <input type="text" value="{{ $sales->name }}" class="w-full border-2 border-gray-700 p-3 rounded-md bg-gray-100 outline-none" readonly>
            </div>

            <div>
                <label>Phone Number</label>
                <input type="text" value="{{ $sales->phone }}" class="w-full border-2 border-gray-700 p-3 rounded-md bg-gray-100 outline-none" readonly>
            </div>

            <div>
                <label>Email Address</label>
                <input type="email" value="{{ $sales->email }}" class="w-full border-2 border-gray-700 p-3 rounded-md bg-gray-100 outline-none" readonly>
            </div>

            <div>
                <label>Means of Identification</label>
                <input type="text" value="{{ $sales->id_type }}" class="w-full border-2 border-gray-700 p-3 rounded-md bg-gray-100 outline-none" readonly>
            </div>

            <div>
                <label>Date of Registration</label>
                <input type="date" value="{{ $sales->registration_date }}" class="w-full border-2 border-gray-700 p-3 rounded-md bg-gray-100 outline-none" readonly>
            </div>

            <div>
                <label>Sales Representative</label>
                <input type="text" value="{{ $sales->sales_rep }}" class="w-full border-2 border-gray-700 p-3 rounded-md bg-gray-100 outline-none" readonly>
            </div>

            <div class="md:col-span-2">
                <label>Residential Address</label>
                <textarea class="w-full border-2 border-gray-700 p-3 rounded-md bg-gray-100 outline-none" readonly>{{ $sales->address }}</textarea>
            </div>

            <div>
                <label>Next of Kin</label>
                <input type="text" value="{{ $sales->nok_name }}" class="w-full border-2 border-gray-700 p-3 rounded-md bg-gray-100 outline-none" readonly>
            </div>

            <div>
                <label>Next of Kin Phone</label>
                <input type="text" value="{{ $sales->nok_phone }}" class="w-full border-2 border-gray-700 p-3 rounded-md bg-gray-100 outline-none" readonly>
            </div>

            <div>
                <label>Occupation / Employer</label>
                <input type="text" value="{{ $sales->occupation }}" class="w-full border-2 border-gray-700 p-3 rounded-md bg-gray-100 outline-none" readonly>
            </div>

            <div class="md:col-span-2">
                <label>Special Notes / Comments</label>
                <textarea class="w-full border-2 border-gray-700 p-3 rounded-md bg-gray-100 outline-none" readonly>{{ $sales->comments }}</textarea>
            </div>
        </div>
    </div>

    {{-- ADMIN PROPERTY DETAILS FORM --}}
    <form action="{{ route('admin.sales.update', $sales->id) }}" method="POST" class="space-y-8">
        @csrf
        @method('PUT')

        {{-- PROPERTY DETAILS --}}
        <div class="section-card">
            <h3 class="section-title">Property Details</h3>
            <hr class="mb-4">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label>Estate / Project Name</label>
                    <input type="text" name="project_name" value="{{ old('project_name', $sales->project_name) }}" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white outline-none" required>
                </div>

                <div>
                    <label>Property Type (Plot / Unit)</label>
                    <input type="text" name="property_type" value="{{ old('property_type', $sales->property_type) }}" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white outline-none">
                </div>

                <div>
                    <label>Plot / Unit Number</label>
                    <input type="text" name="plot_unit_no" value="{{ old('plot_unit_no', $sales->plot_unit_no) }}" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white outline-none">
                </div>

                <div>
                    <label>Location</label>
                    <input type="text" name="location" value="{{ old('location', $sales->location) }}" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white outline-none">
                </div>

                <div>
                    <label>Size (e.g 500sqm)</label>
                    <input type="text" name="size" value="{{ old('size', $sales->size) }}" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white outline-none">
                </div>

                <div>
                    <label>Total Purchase Price</label>
                    <input type="number" name="total_price" value="{{ old('total_price', $sales->total_price) }}" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white outline-none" required>
                </div>

                <div>
                    <label>Payment Option (Full / Installment)</label>
                    <input type="text" name="payment_option" value="{{ old('payment_option', $sales->payment_option) }}" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white outline-none">
                </div>

                <div>
                    <label>Initial Deposit</label>
                    <input type="number" name="initial_deposit" value="{{ old('initial_deposit', $sales->initial_deposit) }}" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white outline-none">
                </div>

                <div>
                    <label>Date of Initial Payment</label>
                    <input type="date" name="initial_date" value="{{ old('initial_date', $sales->initial_date) }}" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white outline-none">
                </div>
            </div>
        </div>

        {{-- PAYMENT SUMMARY --}}
        <div class="section-card">
            <h3 class="section-title">Payment Summary</h3>
            <hr class="mb-4">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label>Total Amount Paid</label>
                    <input type="number" name="total_paid" value="{{ old('total_paid', $sales->total_paid) }}" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white outline-none">
                </div>

                <div>
                    <label>Outstanding Balance</label>
                    <input type="number" name="outstanding_balance" value="{{ old('outstanding_balance', $sales->outstanding_balance) }}" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white outline-none">
                </div>

                <div>
                    <label>Next Due Payment Amount</label>
                    <input type="date" name="next_due_payment" value="{{ old('next_due_payment', $sales->next_due_payment) }}" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white outline-none">
                </div>

                <div>
                    <label>Payment Status </label>
                    <input type="text" name="payment_status" value="{{ old('payment_status', $sales->payment_status) }}" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white outline-none">
                </div>

                <div>
                    <label>Last Payment Date</label>
                    <input type="date" name="last_payment_date" value="{{ old('last_payment_date', $sales->last_payment_date) }}" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white outline-none">
                </div>

                <div>
                    <label>Handled By</label>
                    <input type="text" name="handled_by" value="{{ old('handled_by', $sales->handled_by) }}" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white outline-none">
                </div>
            </div>

            
        </div>

        <button class="w-full bg-black text-white py-3 text-lg font-semibold rounded-lg hover:bg-gray-800 transition">
            Update Sales Record
        </button>
    </form>
</div>

@endsection
