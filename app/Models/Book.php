<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'books';

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
    protected $fillable = ['title', 'description', 'image', 'amazon'];

    public function ellipsified_description ($range = 4) {
        $maxChars = mb_strlen($this->description) > $range ? (mb_strlen($this->description) / $range) :  mb_strlen($this->description);
        $trimmedText = substr($this->description, 0, $maxChars);
        $lastSpacePos = strrpos($trimmedText, ' ');

        if ($lastSpacePos !== false) {
            $trimmedText = substr($trimmedText, 0, $lastSpacePos);
        }

        return rtrim($trimmedText) . '...';
    }

    
}
