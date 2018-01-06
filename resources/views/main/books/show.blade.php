@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2 panel panel-default">
            <div class="panel-heading">
                Book Details
                <span class="pull-right">
                    <a href="{{route('books.index')}}" class="btn-sm btn-success">Index</a>
                    @if(auth()->check())
                        <a href="{{route('admin.books.edit', ['book' => $book])}}" class="btn-sm btn-primary">Edit</a>
                    @endif
                </span>
            </div>
            <div class="panel-body">
                <p><b>Title: </b>{{$book->title}}</p>
                <p><b>Author: </b>{{$book->author}}</p>
                <p><b>Published: </b>{{$book->created_at->format('d/m/Y')}}</p>
                <p><b>Description: </b>{!! nl2br($book->description) !!}</p>
            </div>
        </div>
    </div>
@endsection
