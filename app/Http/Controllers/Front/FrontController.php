<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Tiding;
use App\Models\Likes;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class FrontController extends Controller
{
    private $post;
    protected $comment;
    protected $category;
    protected $like;

    function __construct(Tiding $tiding, Comment $comment, Likes $like)
    {
        $this->post = $tiding;
        $this->comment = $comment;
        $this->like = $like;
        $this->category = Category::all();
    }


    public function index() 
    {
        return view('front.home.home', [
            'posts' => $this->post::latest()->get(),
            'categories' => $this->category
        ]);
    }

    public function details($id) 
    {
        
        $post = $this->post::where('id', $id)->with('category')->first();
        // return $post != null;
        if ($post != null) {
            $is_like = $this->like::where('reader_id', Session::get('reader_id'))->where('tiding_id', $post->id)->first();
            $comments = $this->comment::where('tiding_id', $id)->orderBy('created_at', 'desc')->with('reader')->get();

            $like_count = $this->like->where('tiding_id', $post->id)->where('is_liked', 1)->count();
            $dislike_count = $this->like->where('tiding_id', $post->id)->where('is_liked', 2)->count();

            return view('front.home.details', [
                'post' => $post,
                'comments' => $comments,
                'is_like' => $is_like,
                'categories' => $this->category,
                'like_count' => $like_count,
                'dislike_count' => $dislike_count,
            ]);
        }
        abort(404);
        
    }

    public function dashboard()
    {
        return view('user.dashboard.dashboard', [
            'categories' => $this->category
        ]);
    }

    public function categorizedNews($id)
    {
        $posts = $this->post::where('category_id', $id)->orderBy('id', 'desc')->get();
        if (!empty($posts)) {
            return view('front.home.categorizedNews', [
                'posts' => $posts,
                'categories' => $this->category
            ]);
        }
        else {
            abort(404);

        }
        

    }



    public function test()
    {
                return view('front.test', [
                    'categories' => $this->category
                ]);
    }
}
