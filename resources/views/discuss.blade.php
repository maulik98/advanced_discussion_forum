@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="card">
            <div class="card-header">Create a new Discussion</div>
            <div class="card-body">
                <form action="{{ route('discussion.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="channel">Pick a Channel</label>
                        <select name="channel_id" id="channel_id" class="form-control">
                            @foreach($channels as $channel)
                                <option value="{{ $channel->id }}"> {{ $channel->title }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <lable for="content">Ask a Question</lable>
                        <textarea name="contents" value="{{ old('contents') }}" id="contents" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success float-md-right" type="submit">Create Discussion</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
