@extends('admin.master')

@section('title', 'Manage Categories')

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
                    <th>Tags</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allNews as $news)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $news->title }}</td>
                        <td>{{ $news->body }}</td>
                        <td>{{ $news->image }}</td>
                        <td>{{ $news->category }}</td>
                        <td>{{ $news->tags }}</td>
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
