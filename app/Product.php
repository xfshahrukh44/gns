<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['product_title', 'description','price', 'item_number', 'unspsc', 'manufacturer', 'brand', 'attributes', 'category', 'sku', 'qty' , 'weight'];
    
    protected $appends = ['parent_cat_id','parent_cat_name'];

    public function categorys()
    {
        return $this->belongsTo('App\Category', 'category', 'id');
    }

    public function attributes()
    {
        return $this->hasMany('App\ProductAttribute', 'product_id', 'id');
    }

    public function feature_image ()
    {
        return asset(file_get_contents($this->image) ? $this->image : 'images/noimg.png');
    }
    
    public function getParentCatIdAttribute()
    {
        return $this->categorys ? $this->categorys->parent_id : null;
    }
    
    public function getParentCatNameAttribute()
    {
        // Check if there is a parent category
        if ($this->categorys->parent_id != 0) {
            // Fetch the parent category and return its name
            $parentCategory = Category::find($this->categorys->parent_id);
            return $parentCategory ? $parentCategory->name : null;
        }
        // Return null if there is no parent category
        return null;
    }

    

}
