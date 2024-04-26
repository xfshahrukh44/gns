<?php

namespace App\Jobs;

use App\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateCategory implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $category;
    protected $parent_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($category, $parent_id)
    {
        $this->category = $category;
        $this->parent_id = $parent_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $created_category = Category::firstOrCreate([
            'name' => $this->category->name
        ], [
            'parent_id' => $this->parent_id
        ]);

        //image
        if ($this->category->image) {
            $upload_dir = 'uploads/products';
            $unique_file_name = uniqid() . '_' . basename($this->category->image);
            $destinationPath = public_path($upload_dir) . DIRECTORY_SEPARATOR . $unique_file_name;
            $imageData = file_get_contents($this->category->image);
            if ($imageData !== false) {
                if (file_put_contents($destinationPath, $imageData) !== false) {
                    $created_category->image = $upload_dir . '/' . $unique_file_name;
                    $created_category->save();
                }
            }
        }

        foreach ($this->category->categories as $child_category) {
            dispatch(new CreateCategory($child_category, $created_category->id));
        }
    }
}
