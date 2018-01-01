@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2 panel panel-default">
            <div class="panel-heading">
                Current Books
                <span class="pull-right">
                    @if(auth()->check())
                        <a href="{{route('admin.books.create')}}" class="btn-sm btn-success">Add Book</a>
                    @endif
                </span>
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Published</th>
                        <th>Author</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(count($books) > 0)
                            @foreach($books as $book)
                            <tr>
                                <td>
                                    <a href="{{route('books.show', ['book' => $book])}}">
                                        {{$book->title}}
                                    </a>
                                </td>
                                <td>{{$book->excerpt}}</td>
                                <td>{{$book->created_at->format('d/m/Y')}}</td>
                                <td>{{$book->author}}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" align="center">There are currently no books in the system!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection