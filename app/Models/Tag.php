<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    private static $tag;

    public static function storeTag($input, $id = null)
    {
        isset($id)? self::$tag = Tag::find($id) : self::$tag = new Tag();
        self::$tag->name = $input['name'];
        self::$tag->save();
        return self::$tag;
    }
}
