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

                <form action="{{route('news-likes.store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="tiding_id" value="{{$post->id}}">
                    <div class="card-footer">
                        <span>{{$like_count}} people likes ||</span>
                        <span> {{$dislike_count}} people dislikes</span>
                        <br>
                        @if ( isset($is_like) && $is_like->is_liked == 0)
                            <button type="submit" class="btn btn-outline" name="is_liked" value="1" style="font-size: 30px; text-decoration: none; color: black">🖤 Like</button>
                            <button type="submit" class="btn btn-outline" name="is_liked" value="2" style="font-size: 30px; text-decoration: none; color: black">👎🏿 Dislike</button>
                        @elseif ( isset($is_like) && $is_like->is_liked == 1)
                            <button type="submit" class="btn btn-outline" name="is_liked" value="1" style="font-size: 30px; text-decoration: none; color: black">❤️ Liked</button>
                            <button type="submit" class="btn btn-outline" name="is_liked" value="2" style="font-size: 30px; text-decoration: none; color: black">👎🏿 Dislike</button>
                        @elseif ( isset($is_like) && $is_like->is_liked == 2)
                            <button type="submit" class="btn btn-outline" name="is_liked" value="1" style="font-size: 30px; text-decoration: none; color: black">🖤 Like</button>
                            <button type="submit" class="btn btn-outline" name="is_liked" value="2" style="font-size: 30px; text-decoration: none; color: black">👎 Disliked</button>

                        @endif
                        
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- COMMENTS SECTION --}}
    <div class="row">



        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-muted">Discussion</h3>
                </div>

                <div class="card-body">

                    
                    <div class="col-md-8 mx-auto">
    

                        <div class="position-relative">
                            <div class="chat-messages p-4">

                                @foreach ($comments as $comment)

                    
                                <div class=" pb-4 {{ $comment->reader->id == Session::get('reader_id') ? 'chat-message-right' : 'chat-message-left' }}">
                                    <div>
                                        <img src="{{ $comment->reader->image != null ? asset($post->image) : asset('default/user.jpg') }}" class="rounded-circle me-1" alt="Chris Wood" width="40" height="40">
                                        <div class="text-muted small text-nowrap mt-2">{{  $comment->created_at->format('d M,y') }}</div>
                                    </div>
                                    <div class="flex-shrink-1 bg-light rounded py-2 px-3 me-3">
                                        <div class="font-weight-bold mb-1"><i>{{$comment->reader->name}}</i>
                                        </div>
                                        {{$comment->comment}}
                                        </div>
                                </div>

                                @endforeach
                    
                            </div>
                        </div>
                    {{-- INSERT COMMENTS --}}

                        <form action="{{ route('news-comments.store') }}" method="POST">
                            @csrf
                    
                        <div class="flex-grow-0 py-3 px-4 border-top">
                            <div class="input-group">
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <input type="text" name="comment" class="form-control" placeholder="Type your message">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </div>

                        </form>
                    
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
