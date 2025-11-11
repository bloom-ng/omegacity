<!DOCTYPE html>
<html lang="en">
@include("users.header")

<body class="bg-[#F6F7F9] text-gray-800">

@include("users.nav")

<div class="max-w-5xl mx-auto mt-8 space-y-8">

    <div class="bg-white p-8 shadow-md rounded-xl border border-gray-200">
        <h2 class="text-3xl font-bold mb-6 flex items-center gap-2">
           Sales Tracking Form
        </h2>

        @if(session("success"))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session("success") }}
            </div>
        @endif

        <form action="{{ route('sales.store') }}" method="POST" class="space-y-10">
            @csrf

            {{-- CLIENT INFORMATION --}}
            <div class="section-card">
                <h3 class="section-title">👤 Client Information</h3>
                <hr class="mb-4">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label>Full Name</label>
                        <input name="name" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
 required>
                    </div>

                    <div>
                        <label>Phone Number</label>
                        <input name="phone" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
required>
                    </div>

                    <div>
                        <label>Email Address</label>
                        <input type="email" name="email" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>
                    </div>

                    <div>
                        <label>Means of Identification (Drivers License etc...) </label>
                        <input name="id_type" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>
                    </div>
                     <div>
                        <label>Date of Registration</label>
                        <input type="date" name="registration_date" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>
                    </div>

                    <div>
                        <label>Sales Representative</label>
                        <input name="sales_rep" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>
                    </div>

                    <div class="md:col-span-2">
                        <label>Residential Address</label>
                        <textarea name="address" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
></textarea>
                    </div>

                    <div>
                        <label>Next of Kin</label>
                        <input name="nok_name" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>
                    </div>

                    <div>
                        <label>Next of Kin Phone</label>
                        <input name="nok_phone" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>
                    </div>

                    <div>
                        <label>Occupation / Employer</label>
                        <input name="occupation" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>
                    </div>


                </div>
            </div>


            {{-- NOTES --}}
            <div class="section-card">
                <h3 class="section-title"> Special Notes</h3>
                <hr class="mb-4">

                <textarea name="comments" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none h-28" placeholder="Write comments here..."></textarea>
            </div>

            <button class="w-full bg-black text-white py-3 text-lg font-semibold rounded-lg hover:bg-gray-800 transition">
                Submit & Generate PDF
            </button>

        </form>
    </div>
</div>
<style>
.section-card {
    @apply bg-white border border-black p-6 rounded-lg shadow;
}

.section-title {
    @apply text-xl font-bold mb-4 flex items-center gap-2 text-gray-700;
}

label {
    @apply block mb-1 text-sm font-semibold text-gray-700;
}

</style>
@include("users.footer")

</body>
</html>



