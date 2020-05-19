<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\TextUI\Help;


class ProductsController extends Controller
{
    public $helper;
    public function __construct() {
        $this->helper = new HelperController();
    }

    public function index()
    {
        $products = Product::all();
        return view('shopify.products')->with([
            'products' => $products
        ]);
    }

    public function ProductSync()
    {
        $products = $this->helper->getShopify()->rest('GET', '/admin/products.json', [
            'limit' => 250
        ]);
        
        // foreach ($products->body->products as $product) {
        //     dd($product->options[1]->values);    
        // }
        if($products->errors){
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong, please try again.'
            ]);
        }else {
            $products_array = [];
            foreach ($products->body->products as $product) {
                $db_product = Product::where('shopify_id', $product->id)->first();
                if ($db_product === null) {
                    $db_product = new Product();
                }
                $db_product->shopify_id = $product->id;
                $db_product->title = $product->title;
                $db_product->handle = $product->handle;
                if (isset($product->image)) {
                    $db_product->image = $product->image->src;
                }
                $db_product->price = $product->variants[0]->price;
                $db_product->published_scope = $product->published_at;
                $db_product->save();

                array_push($products_array, $db_product->id);

                $variants_array = [];
                foreach ($product->variants as $variant){
                    $new_variant = ProductVariant::where([
                        'variant_id' => $variant->id,
                        'product_id' => $db_product->id,
                        'shopify_id' => $product->id
                    ])->first();
                    if($new_variant === null){
                        $new_variant = new ProductVariant();
                    }
                    $new_variant->variant_id = $variant->id;
                    $new_variant->price= $variant->price;
                    $new_variant->shopify_id = $product->id;
                    $new_variant->product_id = $db_product->id;
                    $new_variant->save();

                    array_push($variants_array, $new_variant->id);
                }

                ProductVariant::where('product_id', $db_product->id)
                    ->whereNotIn('id', $variants_array)
                    ->delete();
            }

            Product::whereNotIn('id', $products_array)->delete();

            return redirect()->back()->with('success', 'Product Sycn Successfully.');
        }
    }

    public function ProductSyncDomain($domain)
    {
        $products = $this->helper->getShopifyDomain($domain)->rest('GET', '/admin/products.json', [
            'limit' => 250
        ]);

        if($products->errors){
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong, please try again.'
            ]);
        }else {
            $products_array = [];
            foreach ($products->body->products as $product) {
                $db_product = Product::where('shopify_id', $product->id)->first();
                if ($db_product === null) {
                    $db_product = new Product();
                }
                $db_product->shopify_id = $product->id;
                $db_product->title = $product->title;
                $db_product->handle = $product->handle;
                if (isset($product->image)) {
                    $db_product->image = $product->image->src;
                }
                $db_product->price = $product->variants[0]->price;
                $db_product->published_scope = $product->published_at;
                $db_product->save();

                array_push($products_array, $db_product->id);

                $variants_array = [];
                foreach ($product->variants as $variant){
                    $new_variant = ProductVariant::where([
                        'variant_id' => $variant->id,
                        'product_id' => $db_product->id,
                        'shopify_id' => $product->id
                    ])->first();
                    if($new_variant === null){
                        $new_variant = new ProductVariant();
                    }
                    $new_variant->variant_id = $variant->id;
                    $new_variant->price= $variant->price;
                    $new_variant->shopify_id = $product->id;
                    $new_variant->product_id = $db_product->id;
                    $new_variant->save();

                    array_push($variants_array, $new_variant->id);
                }

                ProductVariant::where('product_id', $db_product->id)
                    ->whereNotIn('id', $variants_array)
                    ->delete();
            }

            Product::whereNotIn('id', $products_array)->delete();

            return redirect()->back()->with('success', 'Product Sycn Successfully.');
        }
    }

}
