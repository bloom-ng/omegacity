<?php

namespace App\Http\Controllers\Admin;

use App\Models\Eoi;
use App\Models\Guarantor;
use Illuminate\Http\Request;
use App\Models\SalesTracking;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FormsController extends Controller
{
    public function index()
    {
        return view('admin.forms.index');
    }

    public function eoi()
    {
        $forms = Eoi::latest()->paginate(10);
        return view('admin.forms.eoi', compact('forms'));
    }

    public function guarantor()
    {

        $forms = Guarantor::latest()->paginate(10);
        return view('admin.forms.guarantor', compact('forms'));
    }

    public function salesTracking()
    {
        $forms = SalesTracking::latest()->paginate(10);
        return view('admin.forms.salesTracking', compact('forms'));
    }

    public function download($id, $type)
    {
        switch ($type) {

            case 'eoi':
                $eoi = Eoi::findOrFail($id);
                $pdf = PDF::loadView('admin.pdf.eoipdf', compact('eoi'));
                $fileName = 'eoi-' . $eoi->created_at->format('Ymd') . '-' . $eoi->id . '.pdf';
                return $pdf->stream($fileName);

            case 'guarantor':
                $guarantor = Guarantor::findOrFail($id);
                $pdf = PDF::loadView('admin.pdf.guarantorpdf', compact('guarantor'));
                $fileName = 'guarantor-' . $guarantor->created_at->format('Ymd') . '-' . $guarantor->id . '.pdf';
                return $pdf->stream($fileName);

            case 'salestracking':
                $salestracking = SalesTracking::findOrFail($id);
                $pdf = PDF::loadView('admin.pdf.salespdf', compact('salestracking'));
                $fileName = 'salestracking-' . $salestracking->created_at->format('Ymd') . '-' . $salestracking->id . '.pdf';
                return $pdf->stream($fileName);
        }

        abort(404, 'Invalid form type requested.');
    }

    public function updateEoi(Request $request, $id)
    {
        $request->validate([
            'receiving_manager' => 'required|string',
            'date_received' => 'required|date',
            'approval_status' => 'required|string',
            'remark' => 'nullable|string',
        ]);

        $form = Eoi::findOrFail($id);

        $form->update([
            'receiving_manager' => $request->receiving_manager,
            'date_received' => $request->date_received,
            'approval_status' => $request->approval_status,
            'remark' => $request->remark,
        ]);

        return redirect()->route("admin.forms.eoi")->with('success', 'EOI updated successfully.');
    }


    public function downloadFile($type, $id)
    {
        $eoi = EOI::findOrFail($id);

        if ($type === 'id') {
            $filePath = $eoi->id_file;
        } elseif ($type === 'nok') {
            $filePath = $eoi->nok_id_file;
        } else {
            abort(404);
        }

        // Check file exists in storage/app/public/
        if (!$filePath || !Storage::disk('public')->exists($filePath)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('public')->download($filePath);
    }




    public function edit($id)
    {
        $sales = SalesTracking::findOrFail($id);
        return view('admin.forms.editsales', compact('sales'));
    }

    public function update(Request $request, $id)
    {
        $sales = SalesTracking::findOrFail($id);

        $validated = $request->validate([
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
            'next_due_payment' => 'nullable|date',
            'payment_status' => 'nullable|string',
            'last_payment_date' => 'nullable|date',
            'handled_by' => 'nullable|string',
        ]);

        $sales->update($validated);

        return redirect()->route('admin.forms.sales')->with('success', 'Sales Tracking updated successfully!');
    }
}
