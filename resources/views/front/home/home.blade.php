@extends('front.master')

@section('title', 'Homepage')

@section('content')

    <div class="row" id="template">


{{--        // ajax getData() here--}}


    </div>

@endsection

@section('ajax')

<script>
    getData();
    setInterval("getData()", 10000)
</script>
@endsection
