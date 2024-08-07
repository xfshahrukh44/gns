<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

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
    protected $fillable = ['name', 'heading', 'detail', 'icon', 'image', 'parent_id'];

    public function parent ()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children ()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products ()
    {
        return $this->hasMany(Product::class, 'category', 'id');
    }

    
}
