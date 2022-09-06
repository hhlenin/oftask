<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\Category;
use App\Models\PostTag;
use App\Models\Tag;
use App\Models\Tiding;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $news;
    protected $category;
    protected $tag;
    protected $post_tag;

    function __construct(Tiding $tiding, Category $category, Tag $tag, PostTag $post_tag)
    {
        $this->news = $tiding;
        $this->category = $category;
        $this->tag = $tag;
        $this->post_tag = $post_tag;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allNews = $this->news::with('category')->get();
        return view('admin.news.index', [
            'allNews' => $allNews,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create', [
            'categories' => $this->category::all(['name', 'id']),
            'tags' => $this->tag::all('name', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        $input = $request->only(['title', 'body', 'image', 'category_id', 'tag_id']);

        $response = $this->news::storeNews($input);
        if ($response) {
            return back()->with('message', 'Data saved successfully');
        }
        return back()->with('error', 'Oparation Failed');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post_tags = $this->post_tag->where('post_id', $id)->get('tag_id');

        $post = $this->news::find($id);
        if ($post) {
            return view('admin.news.edit', [
                'post' => $post,
                'categories' => $this->category::all('name', 'id'),
                'tags' => $this->tag::all('name', 'id'),
                'post_tags' => $post_tags,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, $id)
    {
        // return $request;
        $input = $request->only(['title', 'body', 'image', 'category_id', 'tag_id']);

        $response = $this->news::storeNews($input, $id);
        if ($response) {
            return back()->with('message', 'Data updated successfully');
        }
        return back()->with('error', 'Oparation Failed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = $this->news::find($id);
        if ($news) {
            if (isset($news->image)) {
                if (file_exists($news->image)) {
                    unlink($news->image);
                }
            }
            $news->delete();

            $post_tags = $this->post_tag::where('post_id', $id)->get();
            if ($post_tags) {
                foreach ($post_tags as $post_tag) {
                    $post_tag->delete();
                }
            }
            return redirect(route('news.index'))->with('message', 'Data deleted successfully');
        }

        return redirect(route('news.index'))->with('error', 'no data found');
    }
}
