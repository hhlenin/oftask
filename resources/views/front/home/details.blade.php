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
                    <input type="hidden" value="{{ $post->id }}" id="post_id">
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


                        @if(Session::has('reader_id'))


                            @if($is_like == null || $is_like->is_liked == 0)
                                <button type="submit" class="btn btn-outline" name="is_liked" value="1" style="font-size: 30px; text-decoration: none; color: black">🖤 Like</button>
                                <button type="submit" class="btn btn-outline" name="is_liked" value="2" style="font-size: 30px; text-decoration: none; color: black">👎🏿 Dislike</button>
{{--                                @break--}}
                            @elseif($is_like->is_liked == 1)
                                <button type="submit" class="btn btn-outline" name="is_liked" value="1" style="font-size: 30px; text-decoration: none; color: black">❤️ Liked</button>
                                <button type="submit" class="btn btn-outline" name="is_liked" value="2" style="font-size: 30px; text-decoration: none; color: black">👎🏿 Dislike</button>


                            @elseif($is_like->is_liked == 2)
                            <button type="submit" class="btn btn-outline" name="is_liked" value="1" style="font-size: 30px; text-decoration: none; color: black">🖤 Like</button>
                                <button type="submit" class="btn btn-outline" name="is_liked" value="2" style="font-size: 30px; text-decoration: none; color: black">👎 Disliked</button>
                        @endif
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

{{--ajax comment load--}}

                            </div>
                        </div>
                    {{-- INSERT COMMENTS --}}


                        <div class="flex-grow-0 py-3 px-4 border-top">
                            <div class="input-group">
                                <input type="hidden" id="post_id" name="post_id" value="{{ $post->id }}">
                                <input type="text" id="comment" name="comment" class="form-control" placeholder="Type your message">
                                <button type="submit" onclick="storeComment()" class="btn btn-primary">Send</button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('ajax')

    <script>

        let _token = "{{ csrf_token() }}";




        // FETCHING COMMENTS
        function fetchComments()
        {
            let rows = '';
            let reader_id = "{{ Session::get('reader_id') }}"
            let post_id = $('#post_id').val();
                console.log(post_id)
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/fetch-comments/" +post_id,
                success:function (comments) {
                  $.each(comments, function (key, comment) {

                      if(comment.reader.id == reader_id) {
                            rows += '<div class=" pb-4 chat-message-right">'
                      }
                      else {
                          rows += '<div class=" pb-4 chat-message-left">'
                      }

                      rows += '<div>'
                      if (comment.reader.image == null) {
                          rows += '<img src="{{asset('/default/user.jpg')}}" class="rounded-circle me-1" alt="Chris Wood" width="40" height="40">'

                      }
                      else {
                          rows += '<img src="'+ comment.reader.image +'" class="rounded-circle me-1" alt="Chris Wood" width="40" height="40">'

                      }
                              {{--    <div class="text-muted small text-nowrap mt-2">{{  $comment->created_at->format('d M,y') }}</div>--}}
                                  rows += '</div>'
                      rows += '<div class="flex-shrink-1 bg-light rounded py-2 px-3 me-3">'
                      rows += '<div class="font-weight-bold mb-1"><i>' +comment.reader.name + '</i>'
                                  rows += '</div>'
                              rows += comment.comment
                              rows += '</div>'
                      rows += '</div><br>'

                  })

                    $('.chat-messages').html(rows)
                }
            })
        }


        // Storing Comment Function
        function storeComment() {
            let comment = $('#comment').val();
            let post_id = $('#post_id').val();

            $.ajax({
                type : "POST",
                dataType: "json",
                url: "/store/comment",
                data: {
                    _token: _token,
                    comment: comment,
                    post_id: post_id,
                },
                success:function (data){
                    let message = 'Comment Recorded';
                    notify(message);
                    fetchComments();
                    $('#comment').val('');
                }
            })
        }
        fetchComments();


    </script>

@endsection
