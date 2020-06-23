<?php

namespace App\Http\Controllers;

use App\Gift;
use App\Bundle;
use App\Product;
use App\OptionValue;
use App\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GiftController extends Controller
{
    public $helper;
    public function __construct() {
        $this->helper = new HelperController();
    }

    public function giftCreate(){
        return view('shopify.giftCreate')->with([
            'products' => Product::whereNotNull('published_scope')->get()
        ]);
    }

    public function giftedit($id){
        $gift = Gift::where('id',$id)->first();
        $products = Product::whereNotNull('published_scope')->get();

        $data = array(
            'gift'=>$gift,
            'products'=>$products,
        );
        // dd($data);
        return view('shopify.giftCreate')->with($data);
    }

    public function store(Request $request){
    //    dd($request->all());
        $gift_add = new Gift();
        $gift_add->title = $request->Gift_Name;
        $gift_add->triggered_amount = $request->Triggered_Price;
        $gift_add->active = true;
        // dd($gift_add);
        $gift_add->save();


        $data = array();
        $data['gift_id'] =  $gift_add->id;
        $data['product_id'] = $request->product;
        $dataSubmitted =  DB::table('gift_product')->insert($data);
        return redirect(route('gift.edit',$gift_add->id));


    }
    public function storepop(Request $request){
        dd($request->all());
    }

    public function giftupdate(Request $request , $id){
        // dd($request->all());
        $gift = Gift::find($id);
        $data = array(
            'title'=>$request->Gift_Name,
            'triggered_amount' => $request->Triggered_Price,
            'active'=> true

        );
        $gift->update($data);

        DB::table('gift_product')
            ->where('gift_id',$id )
            ->update(['product_id' => $request->product]);

        return redirect( route('gifts.list'));


    }
    public function giftStateUpdate(Request $request , $id){

        Gift::where('id','=',$id)->update(['active' => $request->active]);


        return redirect( route('gifts.list'));


    }
    public function gifts(){
        $gifts = Gift::all();
        $data= array(
            'gifts' => $gifts
        );
        return view('shopify.giftsGrid')->with($data);
    }

    public function destroy($id)
    {
        $gift = Gift::find($id);
        $gift->delete();

        DB::table('gift_product')->where('gift_id',$id)->delete();
        return redirect( route('gifts.list'));
    }
    public function cartGift(){

        $myObj = [];
        $myObj[0]['name'] = "John";
        $myObj[1]['id'] = 123;

        $myJSON = json_encode($myObj);

        $arr = [
            $myJSON
        ];
        dd( $arr);

        // $newarr = [];
        // $newarr[0] = array(
        //     'quantity'=>1,
        //     'id'=>3
        // );
        // $newarr[1] = array(
        //     'quantity'=>1,
        //     'id'=>3
        // );

        // dd($newarr);
    }




    public function cart(Request $request){

            $ids = [];
            $bids = [];
            $sum = 0;
            foreach ($request->cart['items'] as $item) {
                array_push($ids,$item['product_id']);
            }
           $bundles =  Bundle::all();
           foreach ($bundles as $bd) {
               array_push($bids,$bd->product_id);
           }
           $matching = array_intersect($ids,$bids);
           $items = $request->cart['items'];
           foreach ($request->cart['items'] as $item) {
               if($matching){
            for($i=0 ; $i < count($matching);$i++){
                if(($matching[$i] !== $item['product_id'])){
                    $sum+= $item['final_price']*$item['quantity'];
                }
            }
        }else{
            $sum+= $item['final_price']*$item['quantity'];
        }
        }
        $total_price_original = $sum / 100 ;
        $gifts = Gift::where('active',1)->orderBy('triggered_amount')->get();
        $price = Gift::get()->min('triggered_amount');
        $cartTotal =  $total_price_original;
        $products = [];
        if($cartTotal <= $price){
            $data = array(
                'gift'=>'false',
                'products'=> $products
            );
            return $data;
        }else{
            $new_array= [];
            $variants=[];
            $option1=[];
            $option2=[];
            $options=[];
        for ($i = 0; $i < count($gifts); $i++) {
            if($cartTotal > $gifts[$i]->triggered_amount ){
                array_push($new_array,$gifts[$i]->products[0]);
                array_push($variants,$gifts[$i]->products[0]->variants);
                array_push($options,$gifts[$i]->products[0]->options);
                $opt1 = OptionValue::where('product_option_id',$gifts[$i]->products[0]->id)->where('option_database_id',$gifts[$i]->products[0]->options[0]->id)->get();
                if(count($gifts[$i]->products[0]->options) == 1){
                    $opt = [];
                    array_push($option2,null);
                }
                if(count($gifts[$i]->products[0]->options)>1){
                $opt2 = OptionValue::where('product_option_id',$gifts[$i]->products[0]->id)->where('option_database_id',$gifts[$i]->products[0]->options[1]->id)->get();
                array_push($option2,$opt2);

                }
                array_push($option1,$opt1);
            }
        }
        $data = array(
            'gift'=>'true',
            'products'=> $new_array,
            'variants' => $variants,
            'option1' => $option1,
            'option2' => $option2,
            'options'=>$options,

        );
        return $data;
      }
        //Cart With View
    //     $gifts = Gift::where('active',1)->orderByDesc('triggered_amount')->get();
    //     $price = Gift::get()->min('triggered_amount');
    //     $cartTotal =  100;
    //     $products = [];
    //     if($cartTotal <= $price){
    //         $data = array(
    //             'gift'=>'false',
    //             'products'=> $products
    //         );
    //         return  view('shopify.cart')->with($data);

    //     }else{
    //     for ($i = 0; $i < count($gifts); $i++) {
    //         if($cartTotal > $gifts[$i]->triggered_amount ){
    //             $data = array(
    //                 'gift'=>'true',
    //                 'products'=> $gifts[$i]->products
    //             );
    //             return  view('shopify.cart')->with($data);
    //         }

    //     }
    //   }
    }


    public function variants(Request $request){
        // dd($request);
        // dd($request->gifts[4][1]);
        $arr = [];
        for($j=0;$j<count($request->products);$j++){
        for($i=0;$i<count($request->products[$j]['variants']);$i++){

                if($request->products[$j]['variants'][$i]['option1'] == $request->gifts[$j][0]){
                    // dd($request->gifts[$j][1]);
                    if($request->gifts[$j][1] !== "Hidden"){
                        if($request->products[$j]['variants'][$i]['option2'] == $request->gifts[$j][1]){
                            array_push($arr,$request->products[$j]['variants'][$i]['variant_id']);
                        }
                    }else{
                        array_push($arr,$request->products[$j]['variants'][$i]['variant_id']);
                    }
                }
        }

    }
        return $arr;
        // $myObj = [];
        // for($k=0;$k<count($arr);$k++){
        // $myObj[$k]['quantity'] = 1;
        // $myObj[$k]['id'] = $arr[$k] ;
        // }
        // $myJSON = json_encode($myObj);
        // dd($myJSON);

    //     $arrz = [];
    //     $newarr = [];
    //     for($k = 0; $k < count($arr);$k++){
    //     $newarr[] =
    //         [
    //             'quantity'=>1,
    //             'id'=>$arr[$k]
    //         ]
    //   ;
    // }

    //     dd($newarr);



        // return $this->giftIds;
        // $gifts = Gift::where('id',$this->giftIds[0])->get();
        // return $gifts;
        // $variants = ProductVariant::where('product_id', $request->id)->get();
        // return $variants;
    }
    public function multipleProductCart(){

        $gifts = Gift::where('active',1)->orderBy('triggered_amount')->get();
        $price = Gift::get()->min('triggered_amount');
        $cartTotal =  101;
        $products = [];

        if($cartTotal <= $price){
            $data = array(
                'gift'=>'false',
                'products'=> $products
            );
            return  view('shopify.cart')->with($data);
        }else{
            $new_array= [];
        for ($i = 0; $i < count($gifts); $i++) {
            if($cartTotal > $gifts[$i]->triggered_amount ){
                array_push($new_array,$gifts[$i]->products[0]);
            }
        }
        // dd($new_array);
        $data = array(
            'gift'=>'true',
            'products'=> $new_array
        );
        foreach ($data['products'] as $pd) {
            dd($pd['variants']);
        }

        // return  view('shopify.cart')->with($data);
      }


    }

    public function popup(){

        $gifts = Gift::where('active',1)->orderBy('triggered_amount')->get();
        $price = Gift::get()->min('triggered_amount');
        $cartTotal =  101;
        $products = [];

        if($cartTotal <= $price){
            $data = array(
                'gift'=>'false',
                'products'=> $products
            );
            return  view('shopify.popup')->with($data);
        }else{
            $new_array= [];
        for ($i = 0; $i < count($gifts); $i++) {
            if($cartTotal > $gifts[$i]->triggered_amount ){
                array_push($new_array,$gifts[$i]->products[0]);
            }
        }
        // dd($new_array);
        $data = array(
            'gift'=>'true',
            'products'=> $new_array
        );
        return  view('shopify.popup')->with($data);
      }


    }






}
