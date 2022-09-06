@extends('front.master')

@section('title',)
{{$post->title}}
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-heading">
                    <h3>{{$post->title}}</h3>
                    <p><strong>{{$post->created_at->format('d M, Y')}}</strong></p>


                </div>
                <div class="card-body">
                    <img class="card-img-top"
                        src="{{ $post->image != null ? asset($post->image) : asset('default/default.jpg') }}" alt=""
                        style="height: 200px; object-fit: cover">

                    <div class="mt-5">
                        {!! $post->body !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-muted">Discussion</h5>
                </div>
                <div class="col-md-8 text-start p-2 mb-2">
                    <div>
                        <img
                        src="{{ $post->image != null ? asset($post->image) : asset('default/default.jpg') }}" alt=""
                        style="height: 20px; width: 20px; border-radius: 50%; object-fit: cover">
                        <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Provident ipsum quod in voluptates! Itaque officiis provident beatae enim exercitationem voluptate.</span>
                    </div>
                </div>

                <div class="col-md-8 text-end p-2 mb-1 bg-dark text-light">
                    <div>
                        <img
                        src="{{ $post->image != null ? asset($post->image) : asset('default/default.jpg') }}" alt=""
                        style="height: 20px; width: 20px; border-radius: 50%; object-fit: cover">
                        <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Provident ipsum quod in voluptates! Itaque officiis provident beatae enim exercitationem voluptate.</span>
                    </div>
                </div>

                <div class="col-md-8 text-end p-2 mb-1 bg-dark text-light">
                    <span>Post Comment</span>
                    <input type="text" class="form-control mb-1">
                    <input type="submit">
                </div>
            </div>
        </div>
    </div>

@endsection
