<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Orders_Product;
use App\Models\Product;
use App\Models\Delivery;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($request->session()->get('cart_size') <= 0) {
            $request->session()->forget(['cart_size', 'products', 'payment_method', 'delivery_method', 'name', 'surname',
                'phone_number', 'email', 'address', 'city', 'postal_code', 'country', 'products_price', 'total_price']);
            if(isset($user)){
                Order::where('id', $request->session()->get('order_id'))->delete();
                Log::info('Objednavka bola zrusena', ['id' => intval($request->session()->get('order_id'))]);
            }
            $request->session()->forget('order_id');
        }
        $cart_size = $request->session()->get('cart_size');
        if(isset($cart_size)) {
            $products = $request->session()->get('products');
            foreach ($products as $product => $quantity) {
                if ($quantity == 0) {
                    unset($products[$product]);
                    if(isset($user)){
                        Orders_Product::where('order_id', $request->session()->get('order_id'))
                            ->where('product_id', $product)->delete();
                    }
                }
            }
            $request->session()->put('products', $products);
            $cart_content = $request->session()->get('products');
            $products = $this->getCartContent($cart_content);
            $total_price = 0;
            foreach ($products as $product) {
                $total_price += $product['price'];
            }
            $total_price = number_format((float)$total_price, 2);
            return view('cart', ['cart_size' => $cart_size, 'user' => $user, 'products' => $products, 'total_price' => $total_price]);
        }
        else {
            return view('cart', ['user' => $user, 'cart_size' => null]);
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
        $this->updateCart($request, $id);
        return redirect()->route('product', ['id' => $id]);
    }

    public function updateCart($request, $product_id) {
        $user = Auth::id();
        $quantity = intval($request->request->get('quantity'));
        if ($request->session()->has('cart_size')) {
            $cart_size = $request->session()->get('cart_size');

            // ak je produkt uz raz v kosiku
            if (array_key_exists($product_id, $request->session()->get('products'))) {
                $products = $request->session()->get('products');
                $in_stock = Product::find($product_id, ['quantity', 'type']);
                $products[$product_id] += $quantity;
                if(isset($user)){
                    // ak chcem pridat do kosika knihu/film/hudbu ale nie je na sklade
                    if ($in_stock['quantity'] == 0 && $quantity === 1 &&
                        ($in_stock['type'] === 'kniha' || $in_stock['type'] === 'film' || $in_stock['type'] === 'hudba')) {
                        $products[$product_id] -= 1;
                        $quantity = 0;
                    }
                }
                else {
                    // ak chcem pridat do kosika knihu/film/hudbu ale nie je na sklade
                    if ($products[$product_id] > $in_stock['quantity'] &&
                        ($in_stock['type'] === 'kniha' || $in_stock['type'] === 'film' || $in_stock['type'] === 'hudba')) {
                        $products[$product_id] -= 1;
                        $quantity = 0;
                    }
                }
                // ak sme odstranili produkt z kosika
                if ($products[$product_id] < 0) {
                    $products[$product_id] = 0;
                    $quantity = 0;
                }
                $request->session()->put('products', $products);
                if (isset($user)){
                    $previous = Product::find($product_id, ['quantity', 'type']);
                    // ak pridavam do kosika knihu/film/hudbu, odcitam zo skladu
                    if ($previous['type'] === 'kniha' || $previous['type'] === 'film' || $previous['type'] === 'hudba') {
                        Product::where('id', $product_id)
                            ->update(['quantity' => $previous['quantity'] - $quantity]);
                    }

                    $previous = Orders_Product::where('order_id', $request->session()->get('order_id'))
                        ->where('product_id', $product_id)
                        ->first()->quantity;
                    // pridam produkt do kosika
                    Orders_Product::where('order_id', $request->session()->get('order_id'))
                        ->where('product_id', $product_id)
                        ->update(['quantity' => $previous + $quantity]);
                }
            }

            // ak produkt este nie je v kosiku
            else {
                $products = $request->session()->get('products');
                $request->session()->put(['products' => $products + [$product_id => $quantity]]);
                if (isset($user)) {
                    $order_id = Order::where('user_id', $user)
                        ->where('paid_at', null)
                        ->first()->id;
                    $orders_product = new Orders_Product;
                    $orders_product['product_id'] = $product_id;
                    $orders_product['quantity'] = $quantity;
                    $orders_product['order_id'] = $order_id;
                    $orders_product->save();
                    $previous = Product::find($product_id, ['quantity', 'type']);
                    if ($previous['type'] === 'kniha' || $previous['type'] === 'film' || $previous['type'] === 'hudba') {
                        Product::where('id', $product_id)->update(['quantity' => $previous['quantity'] - $quantity]);
                    }
                }
            }

            $request->session()->put(['cart_size' => $cart_size + $quantity]);
        }
        else {
            $request->session()->put(['cart_size' => $quantity, 'products' => [$product_id => $quantity]]);

            if (isset($user)) {
                $order = new Order;
                $order['user_id'] = $user;
                $order->save();
                $order_id = $order['id'];

                $orders_product = new Orders_Product;
                $orders_product['product_id'] = $product_id;
                $orders_product['quantity'] = $quantity;
                $orders_product['order_id'] = $order_id;
                $orders_product->save();

                $previous = Product::find($product_id, ['quantity', 'type']);
                if ($previous['type'] === 'kniha' || $previous['type'] === 'film' || $previous['type'] === 'hudba') {
                    Product::where('id', $product_id)->update(['quantity' => $previous['quantity'] - $quantity]);
                }
                $request->session()->put('order_id', $order_id);
                Log::info('Objednavka bola vytvorena', ['id' => $order_id]);
            }
        }
    }

    public function getCartContent($cart_content) {
        $products = array();
        foreach($cart_content as $product_id => $quantity) {
            if ($quantity > 0) {
                $product = Product::leftJoin('images', 'images.product_id', '=', 'products.id')
                    ->where('images.number', 1)->where('products.id', $product_id)
                    ->select('image', 'title', 'product_id', 'author', 'discounted_price', 'price')
                    ->first();
                if (isset($product['discounted_price'])) {
                    $price = number_format((float)($product['discounted_price'] * $quantity), 2);
                } else {
                    $price = number_format((float)($product['price'] * $quantity), 2);
                }
                array_push($products, ['product' => $product, 'quantity' => $quantity, 'price' => $price]);
            }
        }
        return $products;
    }

    public function changeCart(Request $request, $id) {
        $this->updateCart($request, $id);
        return redirect()->route('cart' );
    }

    public function removeFromCart(Request $request, $product_id) {
        $user = Auth::id();
        $products = $request->session()->get('products');
        foreach ($products as $product => $quantity) {
            if ($product == $product_id) {
                $cart_size = $request->session()->get('cart_size');
                $request->session()->put('cart_size', $cart_size - $quantity);
                $products[$product] = 0;
                if(isset($user)) {
                    $previous = Product::find($product_id, ['quantity', 'type']);
                    if ($previous['type'] === 'kniha' || $previous['type'] === 'film' || $previous['type'] === 'hudba') {
                        Product::where('id', $product_id)->update(['quantity' => $previous['quantity'] + $quantity]);
                    }
                    Orders_Product::where('order_id', $request->session()->get('order_id'))
                        ->where('product_id', $product_id)->delete();
                }
                break;
            }
        }
        $request->session()->put('products', $products);
        return redirect()->route('cart');
    }

    public function getDeliveryPayment(Request $request)
    {
        $user = Auth::user();

        $cart_size = $request->session()->get('cart_size');

        $data_payment = $request->session()->get('payment_method');
        $data_delivery = $request->session()->get('delivery_method');

        $delivery_methods = Delivery::get();
        $payment_methods = Payment::get();

        return view('delivery-and-payment', ['cart_size' => $cart_size, 'user'=> $user,
                                                    'data' => [$data_payment, $data_delivery],
                                                    'delivery_methods' => $delivery_methods,
                                                    'payment_methods' => $payment_methods]);
    }

    public function setDeliveryPayment(Request $request)
    {
        $user = Auth::id();
        $payment_method = $request->request->getInt('SposobPlatby');
        $delivery_method = $request->request->getInt('SposobDopravy');

        $request->session()->put(['payment_method' => $payment_method, 'delivery_method' => $delivery_method]);
        if(isset($user)) {
            Order::where('user_id', $user)->where('paid_at', null)
                ->update(['delivery_method' => $delivery_method, 'payment_method' => $payment_method]);
        }

        if($request->request->get('Button') == 'Next'){
            return redirect()->route('personalInfo');
        }
        else{
            return redirect()->route('cart');
        }

    }

    public function getPersonalInfo(Request $request)
    {
        $user = Auth::user();

        $cart_size = $request->session()->get('cart_size');

        $name = $request->session()->get('name');
        $surname = $request->session()->get('surname');
        $phone_number = $request->session()->get('phone_number');
        $email = $request->session()->get('email');
        $city = $request->session()->get('city');
        $address = $request->session()->get('address');
        $postal_code = $request->session()->get('postal_code');
        $country = $request->session()->get('country');

        return view('personal-info', ['cart_size' => $cart_size, 'user'=> $user, 'data' => ['name' => $name, 'surname'=> $surname,
            'phone_number'=>$phone_number, 'email'=>$email, 'city'=>$city, 'address'=>$address,'postal_code'=>$postal_code,
            'country'=>$country]]);
    }

    public function setPersonalInfo(Request $request)
    {
        $user = Auth::id();
        $name = $request->request->get('name');
        $surname = $request->request->get('surname');
        $phone_number = $request->request->get('phone_number');
        $email = $request->request->get('email');
        $address = $request->request->get('address');
        $city = $request->request->get('city');
        $postal_code = $request->request->get('postal_code');
        $country = $request->request->get('country');

        $request->session()->put(['name'=>$name, 'surname'=>$surname, 'phone_number'=>$phone_number, 'email'=>$email,
            'address'=>$address,'city'=>$city, 'postal_code'=>$postal_code,'country'=>$country]);

        if(isset($user)) {
            Order::where('user_id', $user)->where('paid_at', null)
                ->update(['name'=>$name, 'surname'=>$surname, 'phone_number'=>$phone_number, 'e_mail'=>$email,
                    'address'=>$address,'city'=>$city, 'postal_code'=>$postal_code,'country'=>$country]);
        }

        if($request->request->get('Button') == 'Next'){
            return redirect()->route('checkout');
        }
        else{
            return redirect()->route('deliveryAndPayment');
        }
    }

    public function getCheckout(Request $request) {
        $user = Auth::user();

        $session = $request->session()->all();
        $products = $this->getCartContent($session['products']);
        $delivery = Delivery::find($session['delivery_method']);
        $payment = Payment::find($session['payment_method']);
        $total_price = 0;

        foreach ($products as $product) {
            $total_price += $product['price'];
        }

        $request->session()->put(['products_price' => $total_price]);
        $total_price += $delivery['price'] + $payment['price'];

        $request->session()->put(['total_price' => $total_price]);

        return view('checkout', ['products' => $products, 'delivery' => $delivery, 'payment' => $payment,
                                    'total_price' => $total_price, 'name' => $session['name'],
                                    'surname'=> $session['surname'], 'phone_number'=>$session['phone_number'],
                                    'email'=>$session['email'], 'city'=>$session['city'], 'address'=>$session['address'],
                                    'postal_code'=>$session['postal_code'], 'country'=>$session['country'],
                                    'cart_size' => $session['cart_size'], 'user' => $user]);
    }



    public function placeOrder(Request $request) {
        $user_id = Auth::id();
        $user = Auth::user();
        $session = $request->session()->all();

        if(isset($user)){
            if(!isset($user['name'])){
                User::where('id', $user_id)->update(['name' => $session['name']]);
            }
            if(!isset($user['surname'])){
                User::where('id', $user_id)->update(['surname' => $session['surname']]);
            }
            if(!isset($user['phone_number'])){
                User::where('id', $user_id)->update(['phone_number' => $session['phone_number']]);
            }
            if(!isset($user['email'])){
                User::where('id', $user_id)->update(['email' => $session['email']]);
            }
            if(!isset($user['address'])){
                User::where('id', $user_id)->update(['address' => $session['address']]);
            }
            if(!isset($user['city'])){
                User::where('id', $user_id)->update(['city' => $session['city']]);
            }
            if(!isset($user['postal_code'])){
                User::where('id', $user_id)->update(['postal_code' => $session['postal_code']]);
            }
            if(!isset($user['country'])){
                User::where('id', $user_id)->update(['country' => $session['country']]);
            }
            Log::info('Informacie o pouzivatelovi boli upravene', ['id' => $user_id]);
        }

        $paid_at = \Carbon\Carbon::now();
        if(isset($user)) {
            Order::where('user_id', $user_id)->where('paid_at', null)
                ->update(['paid_at' => $paid_at, 'products_price' => $session['products_price'],
                            'total_price' => $session['total_price']]);
            Log::info('Objednavka bola dokoncena', ['id' => intval($session['order_id'])]);
        }
        else {
            $order = new Order;
            $order['user_id'] = $user_id;
            $order['paid_at'] = $paid_at;
            $order['products_price'] = $session['products_price'];
            $order['delivery_method'] = $session['delivery_method'];
            $order['payment_method'] = $session['payment_method'];
            $order['total_price'] = $session['total_price'];
            $order['name'] = $session['name'];
            $order['surname']= $session['surname'];
            $order['phone_number'] = $session['phone_number'];
            $order['e_mail'] = $session['email'];
            $order['address'] = $session['address'];
            $order['city'] = $session['city'];
            $order['postal_code'] = $session['postal_code'];
            $order['country'] = $session['country'];
            $order->save();

            $order_id = $order['id'];

            foreach ($session['products'] as $product => $quantity) {
                $orders_product = new Orders_Product;
                $orders_product['product_id'] = $product;
                $orders_product['quantity'] = $quantity;
                $orders_product['order_id'] = $order_id;
                $orders_product->save();

                $previous = Product::find($product)['quantity'];
                if(isset($previous)) {
                    $new = $previous - $quantity;
                    Product::where('id', $product)->update(['quantity' => $new]);
                }
            }
            $request->session()->put('order_id', $order_id);
            Log::info('Objednavka bola dokoncena', ['id' => $order_id]);
        }
        $request->session()->put(['paid_at'=> $paid_at]);

        return redirect()->route('index');
    }

}
