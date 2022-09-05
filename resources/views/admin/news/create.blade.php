@extends('admin.master')

@section('title', 'Create News')


@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Create News</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('news.store') }}" method="POST">
                        @csrf
                        <div class="row p-2">
                            <div class="col-md-4">
                                <label for="">News Title</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="title" class="form-control">
                                <span class="text-danger">{{ $errors->has('title') ? $errors->first('title') : '' }}</span>
                            </div>

                        </div>

                        <div class="row p-2">
                            <div class="col-md-4">
                                <label for="">News Details</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="body" class="form-control">
                                <textarea name="body" id="summernote" cols="30" rows="10"></textarea>
                                <span class="text-danger">{{ $errors->has('body') ? $errors->first('body') : '' }}</span>
                            </div>

                            <div class="row p-2">
                                <div class="col-md-4">
                                    <label for="">Image</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="file" name="image" class="form-control">
                                    <span
                                        class="text-danger">{{ $errors->has('image') ? $errors->first('image') : '' }}</span>
                                </div>

                            </div>


                            <div class="row p-2">
                                <div class="col-md-4">
                                    <label for="">Category</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="category" class="form-control">
                                        <option value="" disabled selected>Select a category</option>
                                        <option value="">sgdgdgd</option>
                                        <option value="">sgdgdgd</option>
                                        <option value="">sgdgdgd</option>
                                        <option value="">sgdgdgd</option>
                                    </select>
                                    <span
                                        class="text-danger">{{ $errors->has('category') ? $errors->first('category') : '' }}</span>
                                </div>

                            </div>

                        </div>
                        <div class="row p-2">
                            <div class="col-md-12 float-right">
                                <input type="submit" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>

@endsection
