<?php

namespace App\Jobs;

use App\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateCategoryImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $category;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($category)
    {
        $this->category = $category;
    }

    /**
     * Execute the job.
     *
     * @return false
     */
    public function handle()
    {
        if (!$category = Category::where('name', $this->category->name)->first()) {
            return false;
        }

        //image
        if ($this->category->image) {
            $upload_dir = 'uploads/categories';
            $unique_file_name = uniqid() . '_' . basename($this->category->image);
            $destinationPath = public_path($upload_dir) . DIRECTORY_SEPARATOR . $unique_file_name;
            $imageData = file_get_contents($this->category->image);
            if ($imageData !== false) {
                if (file_put_contents($destinationPath, $imageData) !== false) {
                    $category->image = $upload_dir . '/' . $unique_file_name;
                    $category->save();
                }
            }
        }

        foreach ($this->category->categories as $child_category) {
            dispatch(new UpdateCategoryImage($child_category));
        }
    }
}
