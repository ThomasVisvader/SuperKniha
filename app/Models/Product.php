<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Self_;
use phpDocumentor\Reflection\Types\This;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'products';
    private const PERPAGE = 10;

    public static function getNewProducts(){
        return self::leftJoin('images', 'images.product_id', '=', 'products.id')
                ->where('images.number', 1)->orderBy('products.id', 'desc')
                ->take(10)->get();
    }

    public static function getDiscProducts(){
        return self::leftJoin('images', 'images.product_id', '=', 'products.id')
                ->where('images.number', 1)->whereNotNull('discounted_price')->
                orderBy('products.created_at', 'desc')->take(10)->get();
    }

    public static function getPopularProducts(){
        return self::leftJoin('images', 'images.product_id', '=', 'products.id')
                ->where('images.number', 1)->orderBy('products.rating', 'desc')->take(10)->get();
    }

    public static function getProductsFilters($type, $globalSearch, $localSearch){
        $products_filtre = self::where('products.type', 'LIKE', $type)
            ->Where(function ($query) use ($globalSearch) {
                $query
                    ->where('products.title', 'ILIKE', "%{$globalSearch}%")
                    ->orWhere('products.series', 'ILIKE', "%{$globalSearch}%")
                    ->orWhere('products.author', 'ILIKE', "%{$globalSearch}%")
                    ->orWhere('products.publisher', 'ILIKE', "%{$globalSearch}%");
            })
            ->Where(function ($query) use ($localSearch) {
                $query
                    ->where('products.title', 'ILIKE', "%{$localSearch}%")
                    ->orWhere('products.series', 'ILIKE', "%{$localSearch}%")
                    ->orWhere('products.author', 'ILIKE', "%{$localSearch}%")
                    ->orWhere('products.publisher', 'ILIKE', "%{$localSearch}%");
            })
            ->distinct();

        return $products_filtre;
    }

    public static function getGenres($products_filtre){
        return $products_filtre
            ->select('genre')
            ->get();
    }

    public static function getLanguages($products_filtre){
       return $products_filtre
            ->select('language')
            ->get();
    }

    public static function getFormats($products_filtre){
        return $products_filtre
            ->select('format')
            ->get();
    }

    public static function getProductsMax($globalSearch, $localSearch, $cenaDo, $cenaOd, $hodnotenie, $type){
        return self::leftJoin('images', 'images.product_id', '=', 'products.id')->where('images.number', 1)
            ->Where(function ($query) use ($globalSearch) {
                $query
                    ->where('products.title', 'ILIKE', "%{$globalSearch}%")
                    ->orWhere('products.series', 'ILIKE', "%{$globalSearch}%")
                    ->orWhere('products.author', 'ILIKE', "%{$globalSearch}%")
                    ->orWhere('products.publisher', 'ILIKE', "%{$globalSearch}%");
            })
            ->Where(function ($query) use ($localSearch) {
                $query
                    ->where('products.title', 'ILIKE', "%{$localSearch}%")
                    ->orWhere('products.series', 'ILIKE', "%{$localSearch}%")
                    ->orWhere('products.author', 'ILIKE', "%{$localSearch}%")
                    ->orWhere('products.publisher', 'ILIKE', "%{$localSearch}%");
            })
            ->Where(function ($query) use ($cenaDo) {
                $query
                    ->where('products.discounted_price', '<=', $cenaDo)
                    ->orWhere('products.price', '<=', $cenaDo);
            })
            ->Where(function ($query) use ($cenaOd) {
                $query
                    ->where('products.discounted_price', '>=', $cenaOd)
                    ->orWhere('products.price', '>=', $cenaOd);
            })
            ->where('products.rating', '>=', $hodnotenie)
            ->where('products.type', 'LIKE', $type);
    }

    public static function getProductsFiltered($products_max, $genre_arr, $language_arr, $format_arr){

        if (count($genre_arr) > 0) {
            $products_max = $products_max
                ->whereIn('products.genre', $genre_arr);
        }

        if (count($language_arr) > 0) {
            $products_max = $products_max
                ->whereIn('products.language', $language_arr);
        }

        if (count($format_arr) > 0) {
            $products_max = $products_max
                ->whereIn('products.format', $format_arr);
        }

        return $products_max;

    }

    public static function getMaxPage($products_max){
        return ceil($products_max->count() / self::PERPAGE);
    }

    public static function getProductsOrdered($orderBy, $products_max, $orderType, $page){
        if ($orderBy === 'price') {
            $products = $products_max
                ->select('*')
                ->orderBy('products.discounted_price', $orderType)
                ->orderBy('products.' . $orderBy, $orderType)
                ->simplePaginate(self::PERPAGE, $page);
        } else {
            $products = $products_max
                ->select('*')
                ->orderBy('products.' . $orderBy, $orderType)
                ->simplePaginate(self::PERPAGE, $page);
        }

        return $products;
    }

}
