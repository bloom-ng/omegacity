<?php

namespace App\Http\Controllers\Admin;

use App\Models\Eoi;
use App\Models\Guarantor;
use Illuminate\Http\Request;
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

    public function purchase()
    {
        // When you build purchase model change here
        $forms = [];
        return view('admin.forms.purchase', compact('forms'));
    }

   public function download($id, $type)
{
    if ($type === 'eoi') {
        $eoi = Eoi::findOrFail($id);

        $pdf = PDF::loadView('admin.pdf.eoipdf', compact('eoi'));

        $fileName = 'eoi-' . $eoi->created_at->format('Ymd') . '-' . $eoi->id . '.pdf';

        return $pdf->stream($fileName);
    }

    if ($type === 'guarantor') {
        $guarantor = Guarantor::findOrFail($id);

        $pdf = PDF::loadView('admin.pdf.guarantorpdf', compact('guarantor'));

        $fileName = 'guarantor-' . $guarantor->created_at->format('Ymd') . '-' . $guarantor->id . '.pdf';

        return $pdf->stream($fileName);
    }

    abort(404, 'Invalid form type requested.');
}

}
