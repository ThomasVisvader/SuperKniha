<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Order;
use App\Models\Orders_Product;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $cart_size = $request->session()->get('cart_size');

        return view('auth.login', ['cart_size'=>$cart_size]);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->session()->flush();

        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::id();

        $order = Order::where('user_id', $user)->where('paid_at', null)->first();

        if(isset($order)) {
            $o_products = Orders_Product::where('order_id', $order->id)->get();

            $cart_size = 0;
            $products = array();
            foreach ($o_products as $product) {
                $cart_size += $product->quantity;
                $products[$product->product_id] = $product->quantity;
            }
            $request->session()->put(['cart_size' => $cart_size, 'products' => $products, 'payment_method' => $order->payment_method,
                'delivery_method' => $order->delivery_method, 'name' => $order->name, 'surname' => $order->surname,
                'phone_number' => $order->phone_number, 'email' => $order->e_mail, 'address' => $order->address,
                'city' => $order->city, 'postal_code' => $order->postal_code, 'country' => $order->country,
                'products_price' => $order->products_price, 'total_price' => $order->total_price,
                'order_id' => $order->id]);
        }

        return redirect()->intended(RouteServiceProvider::HOME );
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
