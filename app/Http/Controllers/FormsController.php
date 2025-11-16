<?php

namespace App\Http\Controllers;

use App\Models\Eoi;
use App\Models\Guarantor;
use Illuminate\Http\Request;
use App\Models\SalesTracking;

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

    public function createSalesTracking()
    {
        return view('forms.sales-tracking');
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
            'id_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'passport_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            // NEXT OF KIN
            'nok_name' => 'required',
            'nok_mobile' => 'required',
            'nok_address' => 'required',
            'nok_email' => 'nullable|email',
            'nok_id_type' => 'nullable',
            'nok_id_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',

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

        // Upload applicant ID document
        if ($request->hasFile('id_file')) {
            $original = $request->file('id_file')->getClientOriginalName();
            $filename = $request->id_type . '-' . $original;
            $path = $request->file('id_file')->storeAs('id_docs', $filename, 'public');
            $validated['id_file'] = $path;
        }

        // Upload NOK ID document
        if ($request->hasFile('nok_id_file')) {
            $original = $request->file('nok_id_file')->getClientOriginalName();
            $filename = $request->nok_id_type . '-' . $original;
            $path = $request->file('nok_id_file')->storeAs('nok_id_docs', $filename, 'public');
            $validated['nok_id_file'] = $path;
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

    public function storeSalesTracking(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'id_type' => 'nullable|string',
            'nok_name' => 'nullable|string',
            'nok_phone' => 'nullable|string',
            'occupation' => 'nullable|string',
            'registration_date' => 'nullable|date',
            'sales_rep' => 'nullable|string',

            'project_name' => 'nullable|string',
            'property_type' => 'nullable|string',
            'plot_unit_no' => 'nullable|string',
            'location' => 'nullable|string',
            'size' => 'nullable|string',
            'total_price' => 'nullable|numeric',
            'payment_option' => 'nullable|string',
            'initial_deposit' => 'nullable|numeric',
            'initial_date' => 'nullable|date',

            'total_paid' => 'nullable|numeric',
            'outstanding_balance' => 'nullable|numeric',
            'next_due_payment' => 'nullable|numeric',
            'payment_status' => 'nullable|string',
            'last_payment_date' => 'nullable|date',
            'handled_by' => 'nullable|string',
            'comments' => 'nullable|string'
        ]);

        $sales = SalesTracking::create($validated);
        return back()->with('success', 'Form submitted successfully!');
    }
}
