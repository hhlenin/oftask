<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public $input;
    public $category;

    function __construct(Category $category)
    {
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.category.index', [
            'categories' => $this->category::latest()->get(['name', 'id']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $input = $request->only('name');
        $this->category::storeCategory($input);
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
        $categoryInfo = $this->category::where('id', $id)->first(['id', 'name']);
        if ($categoryInfo) {
            return view('admin.category.edit', [
                'category' => $categoryInfo,
            ]);
        }
        abort(404);
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
        $input = $request->only(['name']);
        $categoryInfo = $this->category::where('id', $id)->first(['id', 'name']);
        if ($categoryInfo) {
            $this->category::storeCategory($input, $id);
            return redirect(route('category.index'))->with('message', 'Data updated successfully');

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
        $this->category::destroy($id);
        if ($this->category) {
            return back()->with('message', 'Data Deleted Successfully');
        }
        return back()->with('message', 'No Data found');

    }
}
