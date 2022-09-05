<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public $tag;

    function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tag.index', [
            'tags' => $this->tag::latest()->get(['name', 'id']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        $input = $request->only('name');
        $this->tag::storeTag($input);
        return back()->with('message', 'Date Saved Successfully');
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
        $tagInfo = $this->tag::where('id', $id)->first(['id', 'name']);
        if ($tagInfo) {
            return view('admin.tag.edit', [
                'tag' => $tagInfo,
            ]);
        }
        return redirect(route('tag.index'))->with('message', 'No Data found');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, $id)
    {
        $input = $request->only(['name']);
        $tagInfo = $this->tag::where('id', $id)->first(['id', 'name']);
        if ($tagInfo) {
            $this->tag::storeTag($input, $id);
            return redirect(route('tag.index'))->with('message', 'Data updated successfully');

        }
        return back()->with('message', 'No Data found');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->tag::destroy($id);
        if ($this->tag) {
            return back()->with('message', 'Data Deleted Successfully');
        }
        return back()->with('message', 'No Data found');
    }
}
