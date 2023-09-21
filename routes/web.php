<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function() {
    return Socialite::driver('vipps')->redirect();
});

Route::get('/login/vipps/callback', function () {

    $vippsUser = Socialite::driver('vipps')->user()->user;

    $user = User::updateOrCreate([
        'vipps_id' => $vippsUser['sub'],
    ], [
        'name' => $vippsUser['name'],
        'family_name' => $vippsUser['family_name'],
        'given_name' => $vippsUser['given_name'],
        'phone_number' => $vippsUser['phone_number'],
        'email' => $vippsUser['email'],
        'email_verified' => $vippsUser['email_verified'],
        'postal_code' => $vippsUser['address']['postal_code'] ?? null,
        'address' => $vippsUser['address'],
        'other_addresses' => $vippsUser['other_addresses'],
        'birthdate' => $vippsUser['birthdate'],
    ]);

    Auth::login($user);

    dd($user);

    return redirect('/');
});
