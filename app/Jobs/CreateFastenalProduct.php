<?php

namespace App\Jobs;

use App\Category;
use App\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class CreateFastenalProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $product;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($product)
    {
        $this->product = $product;
    }

    /**
     * Execute the job.
     *
     * @return false
     */
    public function handle()
    {
        if (!$category = Category::where('name', $this->product->category)->first()) {
            $category_id = null;
        } else {
            $category_id = $category->id;
        }

        $created_product = Product::firstOrCreate([
            'product_title' => $this->product->title,
            'category' => $category_id,
            'sku' => $this->product->sku
        ], [
            'price' => $this->product->price,
            'item_number' => $this->product->manufacturer_part_number,
            'unspsc' => $this->product->unspsc,
            'manufacturer' => $this->product->manufacturer,
            'brand' => $this->product->brand,
            'attributes' => json_encode($this->product->attributes),
            'description' => $this->product->notes,
        ]);

        //feature image
        if ($this->product->feature_image) {
            $upload_dir = 'uploads/products';
            $unique_file_name = uniqid() . '_' . basename($this->product->feature_image);
            $destinationPath = public_path($upload_dir) . DIRECTORY_SEPARATOR . $unique_file_name;
            $imageData = file_get_contents($this->product->feature_image);
            if ($imageData !== false) {
                if (file_put_contents($destinationPath, $imageData) !== false) {
                    $created_product->image = $upload_dir . '/' . $unique_file_name;
                    $created_product->save();
                }
            }
        }

        //images
        foreach ($this->product->images as $image) {
            $upload_dir = 'uploads/products';
            $unique_file_name = uniqid() . '_' . basename($image);
            $destinationPath = public_path($upload_dir) . DIRECTORY_SEPARATOR . $unique_file_name;
            $imageData = file_get_contents($image);
            if ($imageData !== false) {
                if (file_put_contents($destinationPath, $imageData) !== false) {
                    DB::table('product_imagess')->insert([

                        ['image' => ($upload_dir . '/' . $unique_file_name), 'product_id' => $created_product->id]

                    ]);
                }
            }
        }

        return true;
    }
}
