<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Osiset\BasicShopifyAPI;

class HelperController extends Controller
{
    public $api;


    public function getShop(){
        // $shop = Auth::user()->name;
        $shop = 'arctic-cool-store.myshopify.com';
        return User::where('name', $shop)->first();
    }

    public function getShopDomain($shop){
        return User::where('name', $shop)->first();
    }
    public function getShopify(){
        $this->api = new BasicShopifyAPI();
        $this->api->setApiKey(env('SHOPIFY_API_KEY'));
        $this->api->setApiSecret(env('SHOPIFY_API_SECRET'));
        $this->api->setVersion(env('SHOPIFY_API_VERSION'));
        $this->api->setShop($this->getShop()->name);
        $this->api->setAccessToken($this->getShop()->password);
        return $this->api;
    }
    public function getShopifyDomain($domain){
        $shop = User::where('name', $domain)->first();
        $this->api = new BasicShopifyAPI();
        $this->api->setApiKey(env('SHOPIFY_API_KEY'));
        $this->api->setApiSecret(env('SHOPIFY_API_SECRET'));
        $this->api->setVersion(env('SHOPIFY_API_VERSION'));
        $this->api->setShop($shop->name);
        $this->api->setAccessToken($shop->password);
        return $this->api;
    }
}
