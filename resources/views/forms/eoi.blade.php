<!DOCTYPE html>
<html lang="en">
@include("users.header")

<body class="bg-[#F3F3F3] text-[#010504]">

    @include("users.nav")

    <div class="max-w-5xl mx-auto bg-white shadow-md p-8 rounded-lg mt-8">
        <h2 class="text-2xl font-bold mb-6">Expression of Interest Form</h2>

        @if (session("success"))
            <p class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session("success") }}</p>
        @endif

        <form method="POST" action="{{ route("eoi.store") }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- SECTION A -->
            <h3 class="font-bold text-lg border-b mb-2">SECTION A – PERSONAL INFORMATION</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <input name="title" placeholder="Title (Mr/Mrs/Dr)" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>
                <input name="surname" placeholder="Surname" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>
                <input name="first_name" placeholder="First Name" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>
                <input name="other_names" placeholder="Other Names" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>
                <input name="nationality" placeholder="Nationality" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>
                <input name="state_of_origin" placeholder="State of Origin" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>
                <input name="lga" placeholder="LGA" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>
                <input type="date" name="dob" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>
                <select name="sex" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>
                    <option value="">Sex</option>
                    <option>Male</option>
                    <option>Female</option>
                </select>
                <input name="marital_status" placeholder="Marital Status" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>
                <input name="mobile" placeholder="Mobile No" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>
                <input name="email" placeholder="Email" type="email" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>
                <input name="id_type" placeholder="Valid Means of Identification" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>
            </div>

            <textarea name="residential_address" placeholder="Residential Address" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
></textarea>
            <textarea name="business_address" placeholder="Business/Office Address" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
></textarea>

            <!-- Applicant Passport -->
            <label class="block font-semibold">Applicant Passport Photo</label>
            <input type="file" name="passport_photo" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>

            <!-- SECTION B -->
            <h3 class="font-bold text-lg border-b mb-2 mt-6">SECTION B – NEXT OF KIN</h3>

            <input name="nok_name" placeholder="Next of Kin Name" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>
            <input name="nok_mobile" placeholder="Next of Kin Mobile" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>
            <textarea name="nok_address" placeholder="Next of Kin Address" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
></textarea>
            <input name="nok_email" placeholder="Next of Kin Email" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>
            <input name="nok_id_type" placeholder="Next of Kin Valid Means of Identification" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>

            <!-- SECTION C -->
            <h3 class="font-bold text-lg border-b mb-2 mt-6">SECTION C – CATEGORY OF LAND</h3>

            <select name="land_category" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>
                <option value="">Select Land Category</option>
                <option>500 SQM – 5 Bedroom Detached</option>
                <option>450 SQM – 5 Bedroom Detached</option>
                <option>350 SQM – 4 Bedroom Penthouse</option>
                <option>250 SQM – 4 Bedroom Terrace</option>
                <option>180 SQM – 4 Bedroom Terrace</option>
            </select>

            <select name="payment_option" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>
                <option value="">Payment Option</option>
                <option>Full Payment</option>
                <option>Installment</option>
            </select>

            <input name="agent_name" placeholder="Agent Name (Optional)" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>
            <input name="agent_phone" placeholder="Agent Phone (Optional)" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>


            <!-- Bank -->
            <h3 class="font-bold text-lg border-b mb-2 mt-6">Bank Payment Details</h3>

            <div class="p-3 bg-gray-100 rounded">
                <p><strong>Bank Name:</strong> Wema Bank</p>
                <p><strong>Account Name:</strong> Omega City & Properties Nig LTD</p>
                <p><strong>Account Number:</strong> 0127081443</p>
            </div>


            <!-- SECTION D -->
            <h3 class="font-bold text-lg border-b mb-2 mt-6">SECTION D – ENDORSEMENT</h3>

            <input name="applicant_name" placeholder="Applicant Name" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>

            <label class="block font-semibold">Upload Signature</label>
            <input type="file" name="signature_file" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>

            <label class="block font-semibold ">Date Signed</label>
            <input type="date" name="signature_date" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
>

             <label class="block font-semibold ">Additional Info</label>
            <textarea name="additional_info" placeholder="Additional Info" class="w-full border-2 border-gray-700 p-3 rounded-md bg-white focus:ring-2 focus:ring-black focus:border-black outline-none"
></textarea>

            <button class="bg-black text-white px-6 py-2 rounded shadow hover:bg-gray-800 mt-8">
                Submit Application
            </button>

        </form>
    </div>

    @include("users.footer")

</body>

</html>

<style>
    .input {
        @apply w-full border p-2 rounded;
    }
</style>
