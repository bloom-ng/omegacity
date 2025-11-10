<!DOCTYPE html>
<html lang="en">
@include("users.header")

<body class="bg-[#F3F3F3] text-[#010504]">

    @include("users.nav")

   <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow mt-6">

    <h2 class="text-2xl font-bold mb-6">Guarantor Form</h2>

    @if(session("success"))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session("success") }}</div>
    @endif

    <form method="POST" action="{{ route('guarantor.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Candidate section --}}
        <h3 class="font-semibold text-lg border-b mb-2">Candidate Information</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <select name="candidate_title" class="input" required>
                <option value="">Title</option>
                <option>Mr</option><option>Mrs</option><option>Miss</option>
            </select>

            <input name="candidate_name" placeholder="Candidate Full Name" class="input" required>
        </div>

        {{-- Relationship Questions --}}
        <h3 class="font-semibold text-lg border-b mb-2">Guarantor Confirmation</h3>

        <label>Do you personally know the candidate?</label>
        <select name="known_candidate" class="input" required>
            <option value="">Select</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>

        <input name="relationship" placeholder="Relationship to Candidate" class="input" required>
        <input name="known_duration" placeholder="How long have you known them?" class="input" required>
        <input name="occupation" placeholder="Your Occupation" class="input" required>

        {{-- Guarantor Information --}}
        <h3 class="font-semibold text-lg border-b mb-2">Guarantor Personal Information</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <select name="guarantor_title" class="input" required>
                <option value="">Title</option>
                <option>Mr</option><option>Mrs</option><option>Miss</option>
            </select>

            <input name="guarantor_name" placeholder="Guarantor Full Name" class="input" required>
        </div>

        <textarea name="home_address" placeholder="Home Address" class="input" required></textarea>
        <textarea name="office_address" placeholder="Office Address" class="input" required></textarea>

        <input name="candidate_name_confirm" placeholder="Candidate Name (Confirm)" class="input" required>

        {{-- Documentation --}}
        <h3 class="font-semibold text-lg border-b mb-2">Documents</h3>

        <input type="email" name="guarantor_email" placeholder="Email Address" class="input" required>
        <input name="id_type" placeholder="Means of Identification (e.g. NIN, Passport)" class="input" required>

        <label class="block">Upload ID Copy</label>
        <input type="file" name="id_file" class="input">

        <label class="block">Upload Signature</label>
        <input type="file" name="signature_file" class="input">

        <input name="phone" placeholder="Phone Number" class="input" required>
        <input type="date" name="date_signed" class="input" required>

        <button class="bg-black text-white px-6 py-2 rounded shadow hover:bg-gray-800">
            Submit Guarantor Form
        </button>

    </form>
</div>

    @include("users.footer")

</body>

</html>

<style>
    .input {
        @apply w-full border p-5 m-5 rounded;
    }
</style>
