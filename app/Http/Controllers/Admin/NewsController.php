<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Tiding;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $news;
    protected $category;
    protected $tag;


    function __construct(Tiding $tiding, Category $category, Tag $tag)
    {
        $this->news = $tiding;
        $this->category = $category;
        $this->tag = $tag;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.news.index', [
            'allNews' => $this->news::latest()
                ->get(['title', 'body', 'image', 'category_id', 'id']),
            
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
        
        $input = $request->only([
            'title', 'body', 'image', 'category_id', 'tag_id'
        ]);

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
