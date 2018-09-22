@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="card">
            <div class="card-header">Edit Discussion</div>
            <div class="card-body">
                <form action="{{ route('discussion.update',['id' => $discussion->id,'slug' => $discussion->slug]) }}" method="post">
                    {{ csrf_field() }}

                    <div class="form-group row">
                        <label for="title" class="col-md-3 text-right">Title:</label>
                        <input type="text" value="{{ $discussion->title }}" class="form-control col-md-7 " readonly="readonly">
                    </div>

                    <div class="form-group row">
                        <label for="channel" class="col-md-3 text-right">Channel:</label>
                        <option class="form-control col-md-7" readonly="readonly"> {{ $discussion->channel->title }}</option>
                    </div>

                    <div class="form-group row">
                        <lable class="col-md-3 text-right"  for="content" >Ask a Question:</lable>
                        <textarea name="contents" value="contents" id="contents" cols="30" rows="8" class="form-control col-md-8">{{ $discussion->content }}</textarea>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-success float-md-right" type="submit">Update Discussion</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
