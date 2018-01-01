@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2 panel panel-default">
            <div class="panel-heading">
                Create new User
                <span class="pull-right">
                    <a href="{{route('admin.users.index')}}" class="btn-sm btn-success"> Back</a>
                </span>
            </div>
            <div class="panel-body">
                <form action="{{route('admin.users.store')}}" method="post" class="form form-horizontal">
                    {{method_field('PUT')}}
                    {{csrf_field()}}

                    <div class="row">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name" class="control-label col-md-3">Name</label>
                            <div class="col-md-8">
                                <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" required>
                                @if($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('name')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email" class="control-label col-md-3">Email</label>
                            <div class="col-md-8">
                                <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}" required>
                                @if($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('email')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="password" class="control-label col-md-3">Password</label>
                            <div class="col-md-8">
                                <input type="password" name="password" id="password" class="form-control" value="{{old('password')}}" required>
                                @if($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('password')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                            <label for="password_confirmation" class="control-label col-md-3">Confirm Password</label>
                            <div class="col-md-8">
                                <input type="password" name="password_confirmation"
                                       id="password_confirmation" class="form-control"
                                       value="{{old('password_confirmation')}}" required>
                                @if($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('password_confirmation')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-6">
                                <button type="submit" class="btn btn-primary">Create User</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection