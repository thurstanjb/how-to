@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2 panel panel-default">
            <div class="panel-heading">
                Create New Book
                <span class="pull-right">
                    <a href="{{url()->previous()}}" class="btn-sm btn-success">Back</a>
                </span>
            </div>
            <div class="panel-body">
                <form action="{{route('admin.books.store')}}" method="post" class="form form-horizontal">
                    {{method_field('PUT')}}
                    {{csrf_field()}}

                    <div class="row">
                        <div class="form-group  {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="title" class="control-label col-md-3">Title</label>
                            <div class="col-md-8">
                                <input type="text" name="title" id="title" class="form-control" value="{{old('title')}}" required>
                                @if($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('title')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="description" class="control-label col-md-3">Description</label>
                            <div class="col-md-8">
                            <textarea class="form-control" name="description" id="description" rows="5">
                                {{old('description')}}
                            </textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-6">
                                <button type="submit" class="btn btn-primary">Create Book</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
