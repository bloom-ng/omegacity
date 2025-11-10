<?php

namespace App\Http\Controllers;

use App\Models\Eoi;
use App\Models\Guarantor;
use Illuminate\Http\Request;

class FormsController extends Controller
{
    public function createEOI()
    {
        return view('forms.eoi');
    }

     public function createGuarantor()
    {
        return view('forms.guarantor');
    }

    public function storeEOI(Request $request)
    {
        $validated = $request->validate([
            // SECTION A
            'title' => 'required',
            'surname' => 'required',
            'first_name' => 'required',
            'other_names' => 'nullable',
            'nationality' => 'required',
            'state_of_origin' => 'required',
            'lga' => 'required',
            'dob' => 'required|date',
            'sex' => 'required',
            'marital_status' => 'required',
            'mobile' => 'required',
            'residential_address' => 'required',
            'business_address' => 'nullable',
            'email' => 'required|email',
            'id_type' => 'required',
            'passport_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            // NEXT OF KIN
            'nok_name' => 'required',
            'nok_mobile' => 'required',
            'nok_address' => 'required',
            'nok_email' => 'nullable|email',
            'nok_id_type' => 'nullable',

            // SECTION C
            'land_category' => 'required',
            'payment_option' => 'required',

            // Agent Info (optional)
            'agent_name' => 'nullable',
            'agent_phone' => 'nullable',

            // Endorsement
            'applicant_name' => 'required',
            'signature_file' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'signature_date' => 'required|date',
            'additional_info' => 'nullable'
        ]);

        $validated['bank_name'] = 'Wema Bank';
        $validated['account_name'] = 'Omega City & Properties Nig LTD';
        $validated['account_number'] = '0127081443';

        if ($request->hasFile('passport_photo')) {
            $validated['passport_photo'] = $request->passport_photo->store('passports/applicants', 'public');
        }
        if ($request->hasFile('signature_file')) {
            $validated['signature_file'] = $request->signature_file->store('signatures', 'public');
        }
        Eoi::create($validated);

        return back()->with('success', 'Form submitted successfully!');
    }


    public function storeGuarantor(Request $request)
    {
         $validated = $request->validate([
            'candidate_title' => 'required',
            'candidate_name' => 'required',
            'known_candidate' => 'required',
            'relationship' => 'required',
            'known_duration' => 'required',
            'occupation' => 'required',
            'guarantor_title' => 'required',
            'guarantor_name' => 'required',
            'home_address' => 'required',
            'office_address' => 'required',
            'candidate_name_confirm' => 'required',
            'guarantor_email' => 'required|email',
            'id_type' => 'required',
            'phone' => 'required',
            'date_signed' => 'required|date',
            'id_file' => 'nullable|file|mimes:jpg,png,pdf',
            'signature_file' => 'nullable|file|mimes:jpg,png,pdf',
        ]);

        if ($request->hasFile('id_file')) {
            $validated['id_file'] = $request->id_file->store('guarantor/ids', 'public');
        }
        if ($request->hasFile('signature_file')) {
            $validated['signature_file'] = $request->signature_file->store('guarantor/signatures', 'public');
        }

        $g = Guarantor::create($validated);
        return back()->with('success', 'Form submitted successfully!');
    }
}
