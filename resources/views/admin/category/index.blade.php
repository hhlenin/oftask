@extends('admin.master')

@section('title', 'Manage Categories')

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
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{ route('category.edit', $category) }}" class="btn"><i class="align-middle"
                                    data-feather="edit"></i> Edit
                            </a>
                            <a href="" class="btn"
                                onclick="event.preventDefault();
                                        confirm('Are you sure?');
                                        document.getElementById('deleteCategory{{ $category->id }}').submit();
                                        ">
                                <i class="align-middle" data-feather="trash"></i> Delete
                            </a>

                            <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                id="deleteCategory{{ $category->id }}">
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
