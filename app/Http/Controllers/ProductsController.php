<?php

namespace App\Http\Controllers;

use App\Product;
use App\OptionValue;
use App\ProductOption;
use App\ProductVariant;
use PHPUnit\TextUI\Help;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
            // dd($products->body->products[2]->variants); 
        // foreach ($products->body->products as $product) {
        //     dd($product);    
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
                    $new_variant->option1 = $variant->option1;
                    $new_variant->option2 = $variant->option2;
                    $new_variant->option3 = $variant->option3;
                    $new_variant->save();

                    array_push($variants_array, $new_variant->id);
                }

                ProductVariant::where('product_id', $db_product->id)
                    ->whereNotIn('id', $variants_array)
                    ->delete();

                $options_array = [];
                foreach ($product->options as $option){
                    $new_option = ProductOption::where([
                        'option_id' => $option->id,
                        'product_id' => $db_product->id,
                        'shopify_id' => $product->id
                    ])->first();
                    if($new_option === null){
                        $new_option = new ProductOption();
                    }
                    $new_option->option_id = $option->id;
                    $new_option->name= $option->name;
                    $new_option->shopify_id = $product->id;
                    $new_option->product_id = $db_product->id;
                    $new_option->save();

                    array_push($options_array, $new_option->id);

                    foreach ($option->values as $value) {
                        $new_value = OptionValue::where([
                            'product_option_id' => $db_product->id,
                            'option_database_id' => $new_option->id,
                            'value'=> $value
                        ])->first();
                        if($new_value === null){
                            $new_value = new OptionValue();
                        }
                        $new_value->product_option_id = $db_product->id;
                        $new_value->option_database_id = $new_option->id;
                        $new_value->value = $value;
                        $new_value->save();
                    }
                }

                ProductOption::where('product_id', $db_product->id)
                    ->whereNotIn('id', $options_array)
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
