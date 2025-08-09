<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
class LogoSettingController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Settings/Logo', [
            'logo' => Setting::getValue('site_logo'),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            Setting::setValue('site_logo', $path);
        }

        return redirect()->back()->with('success', 'Logo updated.');
    }
}
