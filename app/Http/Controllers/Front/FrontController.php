<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Tiding;
use Illuminate\Http\Request;
use Carbon\Carbon; 

class FrontController extends Controller
{
    private $post;
    function __construct(Tiding $tiding)
    {
        $this->post = $tiding;
    }

    public function index() 
    {
        return view('front.home.home', [
            'posts' => $this->post::latest()->get()
        ]);
    }

    public function details($id) 
    {
        // Carbon::
        $post = $this->post::where('id', $id)->with('category')->first();
        // Carbon::toDayDateTimeString($post->created_at);
        return view('front.home.details', [
            'post' => $post,
        ]);
    }

    public function dashboard()
    {
        return view('user.dashboard.dashboard');
    }
}
