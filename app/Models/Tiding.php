<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiding extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'body', 'category_id'];

    public function getRouteKeyName()
    {
        return ‘slug’;
    }
    protected static $news;
    private static $imageDirectory = 'db/news/';

    protected static function storeNews($input, $id = null)
    {
        // if any id found then trigger the find($id) part and data will be updated or else new data will be stored
        isset($id) ? (self::$news = Tiding::find($id)) : (self::$news = new Tiding());

        self::$news->title = $input['title'];
        self::$news->body = $input['body'];
        isset($input['image']) ? (self::$news->image = imageUpload($input['image'], self::$imageDirectory, self::$news->image)) : '';
        self::$news->category_id = $input['category_id'];
        self::$news->save();

        // delete all data from post_tag table while updating
        if (isset($id)) {
            $post_tags = PostTag::where('post_id', $id)->get();
            foreach ($post_tags as $post_tag) {
                $post_tag->delete();
            }
        }

        // if any tag_id found from input, for every tag_id, post id will stored in the post_tag table

        if (isset($input['tag_id'])) {
            foreach ($input['tag_id'] as $tag) {
                PostTag::create([
                    'post_id' => self::$news->id,
                    'tag_id' => $tag,
                ]);
            }
        }
        return self::$news;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
