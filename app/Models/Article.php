<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'articles';

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
    protected $fillable = ['title', 'content'];

    public function ellipsified_content ($range = 4) {
        $maxChars = mb_strlen($this->content) > $range ? $range :  (mb_strlen($this->content) / $range);
        $trimmedText = substr($this->content, 0, $maxChars);
        $lastSpacePos = strrpos($trimmedText, ' ');

        if ($lastSpacePos !== false) {
            $trimmedText = substr($trimmedText, 0, $lastSpacePos);
        }

        return rtrim($trimmedText) . '...';
    }

    
}
