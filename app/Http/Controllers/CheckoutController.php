<?php

namespace App\Http\Controllers;

use App\ProductVariant;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public $helper;
    public function __construct() {
        $this->helper = new HelperController();
    }
    public function CreateCheckout(Request $request)
    {
        $cart = $request->input('cart');
        $shop = $request->input('shop');
        $cart = json_decode($cart, true);
        $items = [];
//        dd($cart['items']);
        foreach ($cart['items'] as $item){
            array_push($items, [
                'variant_id' => $item['id'],
                'quantity' => $item['quantity']
            ]);
            foreach ($item['properties'] as $index=>$property){
                if(strpos($index, 'product') !== false) {
                    $selected = ProductVariant::where('variant_id', $property)->first();
                    if($selected) {
                        $price = $selected->price * $item['quantity'];
                        array_push($items, [
                            'variant_id' => $property,
                            'quantity' => $item['quantity'],
                            "applied_discount" => [
                                "description" => "Bundle Discount",
                                "value_type" => "percentage",
                                "value" => 100,
                                "amount" => $price,
                                "title" => "Bundle Discount"
                            ]
                        ]);
                    }
                }
            }
        }

        $data = [
            "draft_order" => [
                "line_items" => $items
            ]
        ];

//        dd($data);
        dd($this->helper->getShopDomain($shop));
        $draft_order = $this->helper->getShopDomain($shop)->rest('POST', '/admin/draft_orders', $data);
        if($draft_order->status == true) {
            $response = [
                'status' => 'success',
                'invoice_url' => $draft_order->body->draft_order->invoice_url
            ];
        }else{
            $response = [
                'status' => 'error',
                'invoice_url' => 'Something went wrong.'
            ];
        }
        return response()->json($response);

    }
}
