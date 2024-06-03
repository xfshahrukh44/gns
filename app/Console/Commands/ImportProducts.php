<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use DB;

class ImportProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import products from a JSON file';

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
     * @return int
     */
    public function handle()
    {
        $jsonFilePath = storage_path('app/products.json');
        
        if (!File::exists($jsonFilePath)) {
            $this->error('JSON file not found');
            return;
        }

        $json = File::get($jsonFilePath);
        $products = json_decode($json, true);

        $count = 1;
        foreach ($products as $productData) {
            $imagePath = $this->downloadImage($productData['imgSrc'], $count);
            
            $product = new Product;

            $product->category = $productData['category']; 
            $product->product_title = $productData['title'].', '.$productData['size'];      
			$product->sku = 'N/A';     
			$product->price = 50;   
			$product->item_number = $productData['partNumber'];   
			$product->unspsc = 'N/A';   
            $product->manufacturer = 'N/A';   
            $product->qty = 1;   
            $product->weight = 'N/A';   
            $product->description = $productData['detailedDescription'];
            $product->image = $imagePath;
            $product->save();
            
            DB::table('product_imagess')->insert([
                        
                ['image' => $imagePath, 'product_id' => $product->id]
               
            ]);
            $count++;
            $this->info('Product ID: '.' '.$product->id);
        }

        $this->info('Products imported successfully.');
    }
    
    private function downloadImage($url, $count)
    {
        $contents = file_get_contents($url);
        $name = basename($url);
        $filename = time() . '_' . $name.'_'.$count;
        $path = 'uploads/products/' . $filename;
        file_put_contents(public_path($path), $contents);
        return $path;
    }
}
