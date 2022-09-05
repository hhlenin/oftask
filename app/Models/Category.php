<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    private static $category;

    
    public static function storeCategory($input, $id = null)
    {
        isset($id)? self::$category = Category::find($id) : self::$category = new Category();
        self::$category->name = $input['name'];
        self::$category->save();
        return self::$category; 
    }
}
