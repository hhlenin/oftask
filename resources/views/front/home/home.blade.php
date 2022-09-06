@extends('front.master')

@section('title', 'Homepage')

@section('content')

    <div class="row">
        @foreach ($posts as $post)
            <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('/') }}admin/assets/img/photos/unsplash-1.jpg" alt="Unsplash">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{$post->title}}</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ Str::limit(strip_tags($post->body), 150) }}</p>
                        <a href="{{route('post.details', $post->id)}}" class="btn btn-primary card-link">Read More</a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

@endsection
