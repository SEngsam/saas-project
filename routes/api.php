<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SubscriptionController;
use Illuminate\Support\Facades\Auth;

    Route::get('/test-auth', function () {
    return response()->json(['user' => Auth::user()]);
});
