@extends('front.master')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-heading">
                    <h3>{{ $post->title }}</h3>
                    <p><strong>{{ $post->created_at->format('d M, Y') }}</strong></p>


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

    {{-- COMMENTS SECTION --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-muted">Discussion</h5>
                </div>

                <div class="card-body">
                    @foreach ($comments as $comment)
                        <div class="col-md-8 p-2 mb-2 {{ $comment->reader->id == Session::get('reader_id') ? 'text-end bg-dark text-light' : 'text-start' }}">
                            <div>
                                <img src="{{ $comment->reader->image != null ? asset($post->image) : asset('default/user.jpg') }}"
                                    alt="" style="height: 20px; width: 20px; border-radius: 50%; object-fit: cover">
                                <span class="text-muted">{{$comment->reader->name}}</span>
                                <div>
                                    <span>{{$comment->comment}}</span>
                                    <a>Edit</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- INSERT COMMENTS --}}

                    
                    <form action="{{ route('news-comments.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="post_id" value="{{ $post->id }}">

                        <div class="col-md-8 text-end p-2 mb-1 bg-dark text-light">
                            <span>Post Comment</span>
                            <input type="text" name="comment" class="form-control mb-1">
                            <input type="submit">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
