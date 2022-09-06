<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Tiding;
use Illuminate\Http\Request;
use Carbon\Carbon;
use tidy;

class FrontController extends Controller
{
    private $post;
    protected $comment;

    function __construct(Tiding $tiding, Comment $comment)
    {
        $this->post = $tiding;
        $this->comment = $comment;
    }

    public function index() 
    {
        return view('front.home.home', [
            'posts' => $this->post::latest()->get()
        ]);
    }

    public function details($id) 
    {
        $comments = $this->comment::where('tiding_id', $id)->orderBy('created_at', 'desc')->with('reader')->get();
        $post = $this->post::where('id', $id)->with('category')->first();
        return view('front.home.details', [
            'post' => $post,
            'comments' => $comments
        ]);
    }

    public function dashboard()
    {
        return view('user.dashboard.dashboard');
    }
}
