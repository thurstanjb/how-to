@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2 panel panel-default">
            <div class="panel-heading">
                Edit book
                <span class="pull-right">
                    <a href="{{url()->previous()}}" class="btn-sm btn-success">Back</a>
                </span>
            </div>
            <div class="panel-body">
                <form action="{{route('admin.books.update', ['book' => $book])}}" method="post" class="form form-horizontal">
                    {{method_field('PATCH')}}
                    {{csrf_field()}}
                    <div class="row">
                        <div class="form-group  {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="title" class="control-label col-md-2">Title</label>
                            <div class="col-md-8">
                                <input type="text" name="title" id="title" class="form-control" value="{{$book->title}}" required>
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
                            <label for="description" class="control-label col-md-2">Description</label>
                            <div class="col-md-9">
                            <textarea class="form-control" name="description" id="description" rows="10">
                                {{$book->description}}
                            </textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-5">
                                <button type="submit" class="btn btn-primary">Update Book</button>
                            </div>
                        </div>
                    </div>

                </form>

                @can('delete', $book)
                    <form action="{{route('admin.books.destroy', ['book' => $book])}}" method="post" class="form">
                    {{method_field('DELETE')}}
                    {{csrf_field()}}
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-10">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>
                </form>
                @endcan
            </div>
        </div>
    </div>
@endsection
