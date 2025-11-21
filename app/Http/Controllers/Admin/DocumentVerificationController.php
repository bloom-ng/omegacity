<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invoice;
use App\Models\Receipt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentVerificationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        if (!$search) {
            return view("admin.document-verification.index", [
                'invoices' => [],
                'receipts' => []
            ]);
        }

        $invoices = Invoice::where(function ($query) use ($search) {
            $query->where('id', 'like', "%$search%")
                ->orWhereDate('created_at', $search)
                ->orWhereRaw("CONCAT(DATE_FORMAT(created_at, '%Y%m%d'), id) LIKE ?", ["%$search%"]);
        })->get();

        $receipts = Receipt::where(function ($query) use ($search) {
            $query->where('id', 'like', "%$search%")
                ->orWhereDate('created_at', $search)
                ->orWhereRaw("CONCAT(DATE_FORMAT(created_at, '%Y%m%d'), id) LIKE ?", ["%$search%"]);
        })->get();

        return view("admin.document-verification.index", compact('invoices', 'receipts'));
    }
}
