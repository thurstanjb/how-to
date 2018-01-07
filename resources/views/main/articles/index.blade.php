@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2 panel panel-default">
            <div class="panel-heading">Current Articles</div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Book</th>
                        <th>Author</th>
                        <th>Published</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($articles as $article)
                        <tr>
                            <td>{{$article->title}}</td>
                            <td>{{$article->book->title}}</td>
                            <td>{{$article->author}}</td>
                            <td>{{$article->created_at->format('d/m/Y')}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" align="center">No articles returned!</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection