@extends('admin.master')

@section('title', 'Manage Tags')

@section('content')

    <div class="card-body">
        <table id="datatables-fixed-header" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tag->name }}</td>
                        <td>
                            <a href="{{ route('tag.edit', $tag->id) }}" class="btn"><i class="align-middle"
                                    data-feather="edit"></i> Edit
                            </a>
                            <a href="" class="btn"
                                onclick="event.preventDefault();
                                        confirm('Are you sure?');
                                        document.getElementById('deleteTag{{ $tag->id }}').submit();
                                        ">
                                <i class="align-middle" data-feather="trash"></i> Delete
                            </a>

                            <form action="{{ route('tag.destroy', $tag->id) }}" method="POST"
                                id="deleteTag{{ $tag->id }}">
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
