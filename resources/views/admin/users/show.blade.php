@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2 panel panel-default">
            <div class="panel-heading">
                User Profile
                <span class="pull-right">
                    <a href="{{route('admin.users.index')}}" class="btn-sm btn-success">Index</a>
                    <a href="{{route('admin.users.edit', ['user' => $user])}}" class="btn-sm btn-primary">Edit</a>
                </span>
            </div>
            <div class="panel-body">
                <p><b>Name:</b> {{$user->name}}</p>
                <p><b>Email:</b> {{$user->email}}</p>
                <p><b>Joined:</b> {{$user->created_at->format('d/m/Y')}}</p>
            </div>
        </div>
    </div>
@endsection