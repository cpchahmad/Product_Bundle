<?php

namespace App\Http\Controllers;

use App\Gift;
use App\Product;
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
            'gifts'=>$gifts
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


    public function cart(){

        $gifts = Gift::where('active',1)->orderByDesc('triggered_amount')->get();
        $price = Gift::get()->min('triggered_amount');
        $cartTotal =  71;
        $products = [];
        if($cartTotal <= $price){
            $data = array(
                'gift'=>'false',
                'products'=> $products
            );
            return  view('shopify.cart')->with($data);

        }else{
        for ($i = 0; $i < count($gifts); $i++) {
            if($cartTotal > $gifts[$i]->triggered_amount ){
                $data = array(
                    'gift'=>'true',
                    'products'=> $gifts[$i]->products
                );
                return  view('shopify.cart')->with($data);
            }
            
        }
      }
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
        return  view('shopify.cart')->with($data);
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
