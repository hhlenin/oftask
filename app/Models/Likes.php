<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;

    protected $fillable = ['tiding_id', 'reader_id', 'is_liked'];
    protected static $like;

    public static function storeLike($input, $id = null)
    {
        isset($id)? self::$like = Like::find($id) : self::$like = new Like();
        self::$like->tiding_id = $input['tiding_id'];
        self::$like->reader_id = Session::get('reader_id');
        self::$like->is_liked = $input['is_liked'];
        self::$like->save();
        
    }
}
