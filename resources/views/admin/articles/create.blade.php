@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2 panel panel-default">
            <div class="panel-heading">Create Article</div>
            <div class="panel-body">
                <form action="{{route('admin.articles.store')}}" method="post" class="form form-horizontal">
                    {{method_field('put')}}
                    {{csrf_field()}}
                </form>
            </div>
        </div>
    </div>
@endsection