<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Request $request, $id)
    {
        $user = Auth::user();
        $cart_size = $request->session()->get('cart_size');
        if ($user['id'] == $id) {
            return view('profile', ['user' => $user, 'cart_size' => $cart_size]);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user['name'] = $request['name'];
        $user['surname'] = $request['surname'];
        $user['phone_number'] = $request['phone_number'];
        $user['email'] = $request['email'];
        $user['address'] = $request['address'];
        $user['city'] = $request['city'];
        $user['postal_code'] = $request['postal_code'];
        $user['country'] = $request['country'];
        $user->save();
        Log::info('Informacie o pouzivatelovi boli upravene', ['id' => intval($id)]);
        return redirect()->intended(RouteServiceProvider::HOME );
    }

}
