<?php

namespace App\Console\Commands;

use App\Http\Controllers\ProductsController;
use Illuminate\Console\Command;

class ProductsUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync products Every hour';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $product_controller = new ProductsController();
        $product_controller->ProductSyncDomain('arctic-cool-store.myshopify.com');
    }
}
