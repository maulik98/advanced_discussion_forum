@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="card">
            <div class="card-header text-center">Edit profile</div>

            <div class="card-body">
                <form action="{{ route('profile.update',['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="row form-group">

                        <label class="col-md-3 text-md-right" for="name">Name:</label>
                        <input type="text" value="{{ $user->name }}" name="name" class="form-control col-md-7">
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 text-md-right" for="email">E-Mail Address:</label>
                        <input type="text" value="{{ $user->email }}" name="email" class="form-control col-md-7">
                    </div>

                    <div class="form-group row">
                        <label for="avatar" class="col-md-3 text-md-right">New avatar:</label>
                        <input type="file" name="avatar" class="form-control col-md-7">
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 text-md-right" for="password">Password:</label>
                        <input type="password" name="password" class="form-control col-md-7">
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 text-md-right" for="password">Confirm Password:</label>
                        <input type="pasword" name="password" class="form-control col-md-7">
                    </div>

                    <div class="form-group">
                        <div class="text-center">
                            <button class="btn btn-success" type="submit">
                                Update profile
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
