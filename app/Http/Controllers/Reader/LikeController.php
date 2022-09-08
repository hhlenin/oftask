<?php

namespace App\Http\Controllers\Reader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Likes;
use Session;


class LikeController extends Controller
{

    protected $is_liked;

    function __construct(Likes $likes)
    {
        $this->is_liked = $likes;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->only([
            'is_liked', 'tiding_id'
        ]);
        
        $like = $this->is_liked::where('tiding_id', $input['tiding_id'])->where('reader_id', Session::get('reader_id'))->first();

       
        if (!isset($like)) {
            $this->is_liked::create([
                'tiding_id' => $input['tiding_id'],
                'reader_id' => Session::get('reader_id'),
                'is_liked' => $input['is_liked'],
            ]);
            return back()->with('message', 'Reaction Recorded');
        }


        elseif($like->is_liked == $input['is_liked']) {
            $this->is_liked::where('reader_id', Session::get('reader_id'))->update([
                'is_liked' => 0,
            ]);
            return back()->with('message', 'Reaction Recorded');
        }

        else {
            $this->is_liked::where('reader_id', Session::get('reader_id'))->update([
                'is_liked' => $input['is_liked'],
            ]);
            return back()->with('message', 'Reaction Recorded');
        }
        

    
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
