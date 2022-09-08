@extends('front.master')

@section('content')
<div class="col-12 col-lg-7 col-xl-9">
    

    <div class="position-relative">
        <div class="chat-messages p-4">

            <div class="chat-message-right pb-4">
                <div>
                    <img src="{{asset('/')}}admin/assets/img/avatars/avatar.jpg" class="rounded-circle me-1" alt="Chris Wood" width="40" height="40">
                    <div class="text-muted small text-nowrap mt-2">2:33 am</div>
                </div>
                <div class="flex-shrink-1 bg-light rounded py-2 px-3 me-3">
                    <div class="font-weight-bold mb-1">You</div>
                    Lorem ipsum dolor sit amet, vis erat denique in, dicunt prodesset te vix.
                </div>
            </div>

            <div class="chat-message-left pb-4">
                <div>
                    <img src="{{asset('/')}}admin/assets/img/avatars/avatar-3.jpg" class="rounded-circle me-1" alt="Sharon Lessman" width="40" height="40">
                    <div class="text-muted small text-nowrap mt-2">2:34 am</div>
                </div>
                <div class="flex-shrink-1 bg-light rounded py-2 px-3 ms-3">
                    <div class="font-weight-bold mb-1">Sharon Lessman</div>
                    Sit meis deleniti eu, pri vidit meliore docendi ut, an eum erat animal commodo.
                </div>
            </div>

        </div>
    </div>

    <div class="flex-grow-0 py-3 px-4 border-top">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Type your message">
            <button class="btn btn-primary">Send</button>
        </div>
    </div>

</div>

@endsection