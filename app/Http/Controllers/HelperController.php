<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;
use Osiset\BasicShopifyAPI;

class HelperController extends Controller
{
    public $api;

    public function installAppView(){

    }
    public function installApp(Request $request){
        $shop = $request->input('shop');
        $api_key = env('SHOPIFY_API_KEY');
        $scopes = env('SHOPIFY_API_SCOPES');
        $redirect_uri = env('SHOPIFY_API_REDIRECT_URL');
        $install_url = "https://" . $shop . ".myshopify.com/admin/oauth/authorize?client_id=" . $api_key . "&scope=" . $scopes . "&redirect_uri=" . urlencode($redirect_uri);
        return redirect($install_url);
    }

    public function Authenticate(Request $request)
    {
        $api_key = env('SHOPIFY_API_KEY');
        $shared_secret = env('SHOPIFY_API_SECRET');
        $hmac = $request->input('hmac');

        $query = array(
            "client_id" => $api_key,
            "client_secret" => $shared_secret,
            "code" => $request->input('code')
        );

        // Generate access token URL
        $access_token_url = "https://" . $request->input('shop') . "/admin/oauth/access_token";

        // Configure curl client and execute request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $access_token_url);
        curl_setopt($ch, CURLOPT_POST, count($query));
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($query));
        $result = curl_exec($ch);
        curl_close($ch);

        // Store the access token
        $result = json_decode($result, true);
        $access_token = $result['access_token'];

        $shop_domain = str_replace(".myshopify.com", "", $request->input('shop').'myshopify.com');
        if($shop_domain && $access_token){
            $shop = Shop::where('shopify_domain', $shop_domain)->first();
            if($shop === null){
                $shop =  new Shop();
            }
            $shop->shopify_domain = $shop_domain;
            $shop->access_token = $access_token;
            $shop->save();

            return redirect()->route('admin.dashboard');
        }
    }

    public function getShop(){
        $shop = 'arctic-cool-store.myshopify.com';
        return Shop::where('shopify_domain', $shop)->first();
    }

    public function getShopDomain($shop){
        return Shop::where('shopify_domain', $shop)->first();
    }
    public function getShopify(){
        $this->api = new BasicShopifyAPI();
        $this->api->setApiKey(env('SHOPIFY_API_KEY'));
        $this->api->setApiSecret(env('SHOPIFY_API_SECRET'));
        $this->api->setVersion(env('SHOPIFY_API_VERSION'));
        $this->api->setShop($this->getShop()->shopify_domain);
        $this->api->setAccessToken($this->getShop()->shopify_token);
        return $this->api;
    }
}
