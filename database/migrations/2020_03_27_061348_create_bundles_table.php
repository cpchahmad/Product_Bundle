<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBundlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bundles', function (Blueprint $table) {
            $table->id();
            $table->longText('title')->nullable();
            $table->text('discount_type')->nullable();
            $table->text('total_price')->nullable();
            $table->text('discount')->nullable();
            $table->text('status')->nullable();
            $table->text('product_id')->nullable();
            $table->text('metafield_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bundles');
    }
}
