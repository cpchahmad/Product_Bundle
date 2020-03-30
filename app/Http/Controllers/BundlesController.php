<?php

namespace App\Http\Controllers;

use App\Bundle;
use App\BundleProduct;
use App\Product;
use Illuminate\Http\Request;

class BundlesController extends Controller
{
    public $helper;
    public function __construct() {
        $this->helper = new HelperController();
    }
    public function index(){
        return view('shopify.dashboard')->with([
            'bundles' => Bundle::all(),
            'shop' => $this->helper->getShop()
        ]);
    }


    public function Bundle($id){
            return view('shopify.view')->with([
                'bundle' => Bundle::find($id),
                'products' => Product::whereNotNull('published_scope')->get(),
                'shop' => $this->helper->getShop()
            ]);
    }

    public function create(){
        return view('shopify.create')->with([
            'products' => Product::whereNotNull('published_scope')->get()
        ]);
    }

    public function createPost(Request $request){
        if($request->input('bundle_id')){
            $bundle = Bundle::find($request->input('bundle_id'));
            $message = 'Bundle Updated Successfully!!';
        }else{
            $bundle = new Bundle();
            $message = 'Bundle Create Successfully!!';
        }
        $bundle->title = $request->input('title');
        $bundle->discount_type = $request->input('discount_type');
        $bundle->total_price = $request->input('total_price');
        $bundle->discount = $request->input('discount');
        $bundle->status = $request->input('status');
        $bundle->save();

        $products = [];

        if($request->input('quantity')){
            foreach ($request->input('quantity') as $index=>$product) {
                $quantity = $product;
                $handle = $request->input('handle')[$index];
                $id = $request->input('product')[$index];

                if ($quantity) {
                    $bundle_product = BundleProduct::where([
                        'bundle_id' => $bundle->id,
                        'product_id' => $id
                    ])->first();
                    if ($bundle_product === null) {
                        $bundle_product = new BundleProduct();
                    }
                    $bundle_product->handle = $handle;
                    $bundle_product->quantity = $quantity;
                    $bundle_product->product_id = $id;
                    $bundle_product->bundle_id = $bundle->id;
                    $bundle_product->save();

                    array_push($products, $bundle_product->id);
                }
            }
        }

        $this->CreatProduct($bundle);

        BundleProduct::where('bundle_id', $bundle->id)->whereNotIn('id', $products)->delete();
        return redirect(route('admin.bundles.view', $bundle->id))->with('success', $message);
    }

    public function BundleDelete($id){
        $bundle = Bundle::find($id);
        if($bundle->product_id){
            $this->DeleteProduct($bundle->product_id);
        }
        $bundle->delete();
        BundleProduct::where('bundle_id', $id)->delete();

        return redirect(route('admin.dashboard'))->with('success', 'Bundle Deleted Successfully!!');
    }

    public function CreatProduct($bundle){
        $product_id = $bundle->product_id;
        $metafield_id = $bundle->metafield_id;
        $metafileds = [];
        foreach ($bundle->has_products as $product) {
         array_push($metafileds, $product->quantity.'_'.$product->handle);
        }

        $total_price = $bundle->total_price;
        if($bundle->discount_type == 'fixed'){
            $discount_price = $total_price - $bundle->discount;
        }else{
            $discount_price = $total_price - ($total_price * ($bundle->discount)/100);
        }

        if($bundle->status == 1){
            $published = true;
        }else{
            $published = false;
        }

            if($bundle->product_id){
                $create_product = $this->helper->getShopify()->rest('PUT', '/admin/products/'.$bundle->product_id.'.json', [
                    "product" => [
                        'id' => $bundle->product_id,
                        "title" => $bundle->title,
                        "published" => $published,
                        "variants" => [
                            [
                                "title" => "Default Title",
                                "price" => $discount_price,
                                "inventory_management" => null,
                                "compare_at_price" => $total_price
                            ]
                        ]
                    ]
                ]);
                $create_metafields = $this->helper->getShopify()->rest('PUT', '/admin/metafields/'.$bundle->metafield_id.'.json', [
                    "metafield" => [
                            'id' => $metafield_id,
                            "value" => join(',', $metafileds),
                    ]
                ]);
                $product_id = $create_product->body->product->id;
            }else {
                $create_product = $this->helper->getShopify()->rest('POST', '/admin/products.json', [
                    "product" => [
                        "title" => $bundle->title,
                        "published" => $published,
                        "variants" => [
                            [
                                "title" => "Default Title",
                                "price" => $discount_price,
                                "inventory_management" => null,
                                "compare_at_price" => $total_price
                            ]
                        ],
                        "metafields" => [
                            [
                                "key" => "bundle",
                                "value" => join(',', $metafileds),
                                "value_type" => "string",
                                "namespace" => "products"
                            ]
                        ]
                    ]
                ]);
                $product_id = $create_product->body->product->id;
                $get_all = $this->helper->getShopify()->rest('GET', '/admin/products/' . $product_id . '/metafields.json');
                foreach ($get_all->body->metafields as $metafield) {
                    if ($metafield->key == 'bundle' && $metafield->namespace == 'products') {
                        $metafield_id = $metafield->id;
                    }
                }
            }

        $bundle = Bundle::find($bundle->id);
        $bundle->product_id = $product_id;
        $bundle->metafield_id = $metafield_id;
        $bundle->save();
    }

    public function DeleteProduct($id){
        $this->helper->getShopify()->rest('DELETE', '/admin/products/'.$id.'.json');
    }
}
