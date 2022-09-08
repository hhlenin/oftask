@extends('admin.master')

@section('title', 'Create Category')


@section('content')

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Create New Category</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('category.store')}}" method="POST">
                        @csrf
                        <div class="row p-2">
                            <div class="col-md-4">
                                <label for="">Category Name</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="name" class="form-control">
                                <span class="text-danger">{{ $errors->has('name')? $errors->first('name') : '' }}</span>
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
