<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::latest()->paginate(10);

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request, Setting $setting)
    {
        $validated = $request->validate([
            'value' => 'required|string|max:255',
        ]);

        $setting->update($validated);
          return redirect()->route('admin.settings.index')
            ->with('success', 'Setting updated successfully');

    }
}
