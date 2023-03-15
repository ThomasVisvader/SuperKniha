<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cart_size = $request->session()->get('cart_size');

        $requests = $request->request->all();

        $user = Auth::user();
        $type = $request->request->get('type', '%%');
        $orderBy = $request->request->get('orderBy', 'id');
        $orderType = $request->request->get('orderType', 'DESC');
        $page = $request->request->getInt('page', 1);

        $globalSearch = $request->request->get("globalSearch", '');
        $localSearch = $request->request->get("localSearch", '');

        $cenaOd = $request->request->getInt('cenaOd', 0);
        $cenaDo = $request->request->getInt('cenaDo', 10 ** 7);
        $hodnotenie = $request->request->getInt('hodnotenie', 0);

        if ($cenaDo == 0 || $cenaDo < $cenaOd) {
            $cenaDo = 10 ** 7;
        }

        $genre_arr = array();
        $language_arr = array();
        $format_arr = array();

        $products_filtre = Product::getProductsFilters($type, $globalSearch, $localSearch);
        $genres = Product::getGenres($products_filtre);
        $languages = Product::getLanguages($products_filtre);
        $formats = Product::getFormats($products_filtre);

        foreach ($genres as $genre) {
            if (isset($requests['genre-' . $genre['genre']]) && $requests['genre-' . $genre['genre']] == 'on') {
                array_push($genre_arr, $genre['genre']);

            }
        }

        foreach ($languages as $language) {
            if (isset($requests['language-' . $language['language']]) && $requests['language-' . $language['language']] == 'on') {
                array_push($language_arr, $language['language']);

            }
        }

        foreach ($formats as $format) {
            if (isset($requests['format-' . $format['format']]) && $requests['format-' . $format['format']] == 'on') {
                array_push($format_arr, $format['format']);

            }
        }

        $products_max = Product::getProductsMax($globalSearch, $localSearch, $cenaDo, $cenaOd, $hodnotenie, $type);

        $products_max = Product::getProductsFiltered($products_max, $genre_arr, $language_arr, $format_arr);

        $maxPage = Product::getMaxPage($products_max);

        $products = Product::getProductsOrdered($orderBy, $products_max, $orderType, $page);

        return view('search', ['products' => $products, 'type' => $type, 'orderBy' => $orderBy,
            'orderType' => $orderType, 'page' => $page,
            'maxPage' => $maxPage, 'user' => $user,
            'globalSearch' => $globalSearch, 'genres' => $genres, 'formats' => $formats, 'languages' => $languages,
            'localSearch' => $localSearch, 'requests' => $requests, 'cart_size'=>$cart_size]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        return view ('new-product', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $filenames = $this->createImages($request);
        if ($filenames === null) {
            return back();
        }

        $volume = intval($request->get('volume'));
        if ($volume == 0) {
            $volume = null;
        }

        $price = floatval(str_replace(',', '.', $request->get('price')));

        $discounted_price = floatval(str_replace(',', '.', $request->get('discounted_price')));
        if ($discounted_price == 0) {
            $discounted_price = null;
        }

        $quantity = intval($request->get('quantity'));
        if ($quantity == 0) {
            $quantity = null;
        }

        $page_count = intval($request->get('page_count'));
        if ($page_count == 0) {
            $page_count = null;
        }

        $rating = floatval(str_replace(',', '.', $request->get('rating')));

        $product = new Product;
        $product['title'] = $request->get('title');
        $product['price'] = $price;
        $product['discounted_price'] = $discounted_price;
        $product['quantity'] = $quantity;
        $product['rating'] = $rating;
        $product['language'] = $request->get('language');
        $product['type'] = $request->get('type');
        $product['description'] = $request->get('description');
        $product['series'] = $request->get('series');
        $product['volume'] = $volume;
        $product['author'] = $request->get('author');
        $product['genre'] = $request->get('genre');
        $product['format'] = $request->get('format');
        $product['age_group'] = $request->get('age_group');
        $product['publisher'] = $request->get('publisher');
        $product['page_count'] = $page_count;
        $product['isbn'] = $request->get('isbn');
        $product['length'] = $request->get('length');
        $product->save();


        Log::info('Produkt bol vytvoreny', ['id' => $product['id']]);

        for ($i = 0; $i<sizeof($filenames); $i++) {
            $image = new Image;
            $image['image'] = $filenames[$i];
            $image['product_id'] = $product['id'];
            $image['number'] = $i+1;
            $image->save();
        }

        return redirect(route('index'));

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function show(Request $request, $id)
    {
        $cart_size = $request->session()->get('cart_size');
        $user = Auth::user();

        $product = Product::find($id);
        if ($product === null) {
            return redirect(route('index'));
        }
        $images = Image::select('image')->where('product_id', $id)->orderBy('number')->get();

        if (isset($user)) {
            $available = $product['quantity'];
        }
        else {
            if ($request->session()->has('cart_size') &&
                array_key_exists($id, $request->session()->get('products')) &&
                isset($product['quantity'] )) {
                $available = $product['quantity'] - $request->session()->get('products')[$id];
            }
            else {
                $available = $product['quantity'];
            }
        }

        return view('details', ['product' => $product, 'images' => $images, 'user' => $user, 'cart_size'=>$cart_size, 'available'=>$available]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $product = Product::where('products.id', '=' , $id)->first();
        if ($product === null) {
            return redirect(route('index'));
        }
        $images = Image::where('product_id', $id)->orderBy('number')->get();
        return view ('edit-product', ['user' => $user, 'product' => $product, 'images' => $images]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $images = Image::where('product_id', $id)->get();
        $newimages = array();
        $count = 1;
        while ($request->get('obrazok' . $count) !== null) {
            array_push($newimages, $request->get('obrazok' . $count));
            $count++;
        }
        foreach($images as $image){
            $index = array_search($image['image'], $newimages);
            if ($index === false) {
                unlink('storage/images/w-75/' . $image['image']);
                unlink('storage/images/w-100/' . $image['image']);
                unlink('storage/images/w-150/' . $image['image']);
                unlink('storage/images/w-250/' . $image['image']);
                $image->delete();
            }
            else {
                $image['number'] = $index+1;
                $image->save();
            }
        }

        $count = sizeof($newimages);
        $filenames = $this->createImages($request);
        if ($filenames === null) {
            return back();
        }

        $volume = intval($request->get('volume'));
        if ($volume == 0) {
            $volume = null;
        }

        $price = floatval(str_replace(',', '.', $request->get('price')));

        $discounted_price = floatval(str_replace(',', '.', $request->get('discounted_price')));
        if ($discounted_price == 0) {
            $discounted_price = null;
        }

        $quantity = intval($request->get('quantity'));
        if ($quantity == 0) {
            $quantity = null;
        }

        $page_count = intval($request->get('page_count'));
        if ($page_count == 0) {
            $page_count = null;
        }

        $rating = floatval(str_replace(',', '.', $request->get('rating')));

        $product = Product::find($id);
        $product['title'] = $request->get('title');
        $product['price'] = $price;
        $product['discounted_price'] = $discounted_price;
        $product['quantity'] = $quantity;
        $product['rating'] = $rating;
        $product['language'] = $request->get('language');
        $product['description'] = $request->get('description');
        $product['series'] = $request->get('series');
        $product['volume'] = $volume;
        $product['author'] = $request->get('author');
        $product['genre'] = $request->get('genre');
        $product['format'] = $request->get('format');
        $product['age_group'] = $request->get('age_group');
        $product['publisher'] = $request->get('publisher');
        $product['page_count'] = $page_count;
        $product['isbn'] = $request->get('isbn');
        $product['length'] = $request->get('length');
        $product->save();

        for ($i = 0; $i<sizeof($filenames); $i++) {
            $count++;
            $image = new Image;
            $image['image'] = $filenames[$i];
            $image['product_id'] = $id;
            $image['number'] = $count;
            $image->save();
        }
        Log::info('Produkt bol upraveny', ['id' => intval($id)]);
        return redirect(route('editProduct', ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $images = Image::where('product_id', $id)->get();
        foreach ($images as $image){
            unlink('storage/images/w-75/' . $image['image']);
            unlink('storage/images/w-100/' . $image['image']);
            unlink('storage/images/w-150/' . $image['image']);
            unlink('storage/images/w-250/' . $image['image']);
            $image->delete();
        }
        $product = Product::find($id);
        $product->delete();
        Log::info('Produkt bol vymazany', ['id' => intval($id)]);
        return back();
    }

    public function createImages(Request $request) {
        $images = $request->allFiles();
        $filenames = array();
        foreach($images as $image) {
            $type = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
            if (!in_array($type, ['jpg', 'jpeg', 'png'])) {
                return null;
            }
        }

        foreach($images as $image) {
            $path = $image->store('/storage/images');
            $filename = substr($path, 14);
            array_push($filenames, $filename);
        }

        foreach ($filenames as $filename){
            $type = pathinfo($filename, PATHINFO_EXTENSION);
            if ($type === 'jpg' || $type === 'jpeg'){
                $image = imagecreatefromjpeg('../public/storage/images/'.$filename);
            }
            else {
                $image = imagecreatefrompng('../public/storage/images/'.$filename);
            }

            foreach([75, 100, 150, 250] as $width) {
                $imgResized = imagescale($image, $width);
                if ($type === 'jpg') {
                    imagejpeg($imgResized, '../public/storage/images/w-' . $width . '/' . $filename);
                }
                else {
                    imagepng($imgResized, '../public/storage/images/w-' . $width . '/' . $filename);
                }
            }

            unlink('storage/images/' . $filename);
        }
        return $filenames;
    }
}
