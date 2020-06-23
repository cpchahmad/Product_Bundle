<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// ->middleware('auth.shopify')
Route::get('/', 'BundlesController@index')->name('home');
// Route::group(['prefix' => 'admin', 'middleware' => ['auth.shopify']], function(){
    Route::group(['prefix' => 'admin'], function(){
    Route::get('/', 'BundlesController@index')->name('home');
    Route::get('gifts/create','GiftController@giftCreate')->name('gift.create');
    Route::get('gifts/edit/{id}','GiftController@giftedit')->name('gift.edit');
    Route::post('gifts/store','GiftController@store')->name('gift.store');
    Route::post('gifts/storepop','GiftController@storepop')->name('giftpop.store');
    Route::patch('update/{gift}','GiftController@giftupdate')->name('gift.update');
    Route::patch('updateStatus/{gift}','GiftController@giftStateUpdate')->name('gift.state.update');
    Route::get('gifts','GiftController@gifts')->name('gifts.list');
    Route::delete('gifts/delete/{id}', 'GiftController@destroy')->name('gift.destroy');

    Route::get('cartGift','GiftController@cartGift')->name('gift.cartgift');
    Route::get('multipleProductCart','GiftController@multipleProductCart')->name('gift.multipleProductCart');
    Route::get('dashboard', 'BundlesController@index')->name('admin.dashboard');
    Route::get('bundles', 'BundlesController@index')->name('admin.bundles');
    Route::get('create', 'BundlesController@create')->name('admin.bundles.create');
    Route::post('create/bundle', 'BundlesController@createPost')->name('admin.bundles.create.post');
    Route::get('bundles/{id}', 'BundlesController@Bundle')->name('admin.bundles.view');
    Route::get('bundles/{id}/delete', 'BundlesController@BundleDelete')->name('admin.bundles.delete');
    Route::get('products', 'ProductsController@index')->name('admin.products');
    Route::get('products/sync', 'ProductsController@ProductSync')->name('admin.products.sync');
});

Route::any('checkout', 'CheckoutController@CreateCheckout')->name('create.checkout');
Route::post('/cart','GiftController@cart')->name('gift.cart');
Route::get('/popup','GiftController@popup');
Route::post('variants','GiftController@variants');
