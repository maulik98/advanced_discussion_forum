@extends('layouts.app')

@section('content')
    @foreach($discussions as $discussion)
        <div class="card">
            <div class="card-header">
                <img src="{{ $discussion->user->avatar }}" width="50px" height="50px" style="border-radius: 50%"> &nbsp;&nbsp;
                {{ $discussion->user->name }},<b> {{ $discussion->created_at->diffForHumans() }}</b>
                @if($discussion->hasBestAnswer())
                    <button class="btn btn-success btn-sm float-md-right" style="margin-left: 10px">Closed </button>
                @else
                    <button class="btn btn-danger btn-sm float-md-right" style="margin-left: 10px">Opened</button>
                @endif
                <a href="{{ route('forum.view',['id' => $discussion->id,'slug' => $discussion->slug]) }}" class="btn btn-outline-primary btn-sm float-md-right">View</a>
            </div>

            <div class="card-body">
                <h3 class="text-center"> {{ $discussion->title }} </h3>
                <p>
                    {{ str_limit( $discussion->content ,185) }}
                </p>
            </div>

            <div class="card-footer col-sm-auto" >
                {{ $discussion->replies->count() }} replies
                <a href="{{ route('channel',['id' => $discussion->id,'slug' => $discussion->channel->slug]) }}" class="btn btn-sm btn-outline-secondary float-md-right">{{ $discussion->channel->title }}</a>
            </div>
        </div>
        <br>
    @endforeach
@endsection
