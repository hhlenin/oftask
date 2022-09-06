@extends('admin.master')

@section('title', 'All News')

@section('content')

    <div class="card-body">
        <table id="datatables-fixed-header" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allNews as $news)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $news->title }}</td>
                        <td>{{ Str::limit($news->body, 50) }}</td>
                        <td><img src="{{ $news->image != null ? asset($news->image) : asset('default/default.jpg') }}" alt="" style="width: 50px; height: 50px; object-fit: cover"></td>
                        <td>{{ $news->category->name }}</td>
                        <td>
                            <a href="{{ route('news.edit', $news->id) }}" class="btn"><i class="align-middle"
                                    data-feather="edit"></i> Edit
                            </a>
                            <a href="" class="btn"
                                onclick="event.preventDefault();
                                        confirm('Are you sure?');
                                        document.getElementById('deleteNews{{ $news->id }}').submit();
                                        ">
                                <i class="align-middle" data-feather="trash"></i> Delete
                            </a>

                            <form action="{{ route('news.destroy', $news->id) }}" method="POST"
                                id="deleteNews{{ $news->id }}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>
    </div>

        @endsection

        @section(' javascript')
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    $("#datatables-fixed-header").DataTable({
                        fixedHeader: true,
                        pageLength: 10
                    });
                });
            </script>

        @endsection
