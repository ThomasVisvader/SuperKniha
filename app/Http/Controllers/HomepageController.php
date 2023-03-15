<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $order_id = null;
        $paid_at = $request->session()->get('paid_at');
        if(isset($paid_at)){
            $order_id = $request->session()->get('order_id');
            $request->session()->forget(['cart_size', 'products', 'payment_method', 'delivery_method', 'name', 'surname',
                'phone_number', 'email', 'address', 'city', 'postal_code', 'country', 'products_price', 'total_price', 'order_id', 'paid_at']);
        }
        $new_products = Product::getNewProducts();
        $disc_products = Product::getDiscProducts();
        $popular_products = Product::getPopularProducts();

        $cart_size = $request->session()->get('cart_size');

        return view('index', ['new_products'=>$new_products, 'disc_products'=>$disc_products,
                                    'popular_products'=>$popular_products, 'user'=>$user, 'cart_size'=>$cart_size, 'order_id'=>$order_id]);
    }

}
