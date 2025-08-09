<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    public function application()
    {
        $settings = [
            'app_name' => Setting::getValue('app_name', 'Zaisub'),
            'app_email' => Setting::getValue('app_email', 'zaisub@zainikthemes.com'),
            'app_contact' => Setting::getValue('app_contact', '12345678'),
            'app_location' => Setting::getValue('app_location', '123 Main St, New York, NY 10001'),
            'app_copyright' => Setting::getValue('app_copyright', '© 2023 Zaisub. All Rights Reserved'),
            'footer_text' => Setting::getValue('footer_text', 'Our subscription and billing management system'),
            'developed_by' => Setting::getValue('developed_by', 'zainiklab'),
            'timezone' => Setting::getValue('timezone', 'UTC'),
        ];

        return Inertia::render('Admin/Settings/Application', [
            'settings' => $settings,
            'success' => session('success'), // <-- flash key 'success'
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'app_name' => 'required|string|max:255',
            'app_email' => 'required|email',
            'app_contact' => 'required|string|max:20',
            'app_location' => 'required|string|max:255',
            'app_copyright' => 'required|string',
            'footer_text' => 'required|string',
            'developed_by' => 'required|string',
            'timezone' => 'required|string',
        ]);

        foreach ($validated as $key => $value) {
            Setting::setValue($key, $value);
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

    public function logo()
    {
        $logoKeys = [
            'app_preloader_url',
            'app_logo_url',
            'app_white_logo_url',
            'app_favicon_url',
            'app_auth_logo_url',
        ];
        $settings = Setting::whereIn('key', $logoKeys)
            ->pluck('value', 'key')
            ->toArray();

        // Define default paths for your images (relative to public/storage or assets)

        $settings = array_map(fn($path) => $path ? asset($path) : null, $settings);

        return Inertia::render('Admin/Settings/Logo', [
            'settings' => $settings,
        ]);
    }
}
