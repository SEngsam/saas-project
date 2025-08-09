<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user() ? array_merge($request->user()->only('id', 'name', 'email', 'phone', 'username'), [
                    'role' => $request->user()->getRoleNames()->first(),
                ]) : null,
            ],
            // 'appLogo' => function () {
            //     $logoPath = Setting::getValue('site_logo', 'default-logo.png');
            //     return asset('storage/' . $logoPath);
            // },
            'flash' => [
                'success' => Session::get('success'),
            ],
            'notifications' => fn() =>
            Auth::check() ? Auth::user()->notifications()->latest()->take(10)->get() : [],

        ];
    }
}
