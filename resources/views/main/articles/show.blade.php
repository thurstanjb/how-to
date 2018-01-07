@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2 panel panel-default">
            <div class="panel-heading">Article Details</div>
            <div class="panel-body">
                <p><b>Title: </b>{{$article->title}}</p>
                <p><b>Author: </b>{{$article->author}}</p>
                <p><b>Published: </b>{{$article->created_at->format('d/m/Y')}}</p>
                <p><b>Body: </b>{!! nl2br($article->body) !!}</p>
            </div>
        </div>
        <div class="col-md-2 panel panel-default">
            <div class="panel-heading">Book Details</div>
            <div class="panel-body">
                <p><b>Title: </b><a href="{{$book->path()}}">{{$book->title}}</a></p>
                <p><b>published: </b>{{$book->created_at->format('d/m/Y')}}</p>
                <p>{{$book->description}}</p>
            </div>
        </div>
    </div>
@endsection