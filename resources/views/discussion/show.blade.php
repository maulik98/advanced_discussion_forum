@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <img src="{{ $discussion->user->avatar }}" width="50px" height="50px" style="border-radius: 50%"> &nbsp;&nbsp;
            {{ $discussion->user->name }} <b>{{ $discussion->created_at->diffForHumans() }}</b>
            @if($discussion->is_being_watched_by_auth_user())
                <a href="{{ route('discussion.unwatch',['id' => $discussion->id]) }}" class="btn btn-sm btn-outline-secondary float-md-right">Unwatch</a>
            @else
                <a href="{{ route('discussion.watch',['id' => $discussion->id]) }}" class="btn btn-sm btn-outline-secondary float-md-right">Watch</a>
            @endif

            @if(Auth::id() == $discussion->user->id )
                <a href="{{ route('discussion.delete',['id' => $discussion->id]) }}" class="btn btn-danger float-md-right btn-sm" style="margin-right: 10px">Delete</a>
                <a href="{{ route('discussion.edit',['id' => $discussion->id, 'slug' => $discussion->slug]) }}" class="btn btn-primary float-md-right btn-sm" style="margin-right: 10px">Edit</a>
            @endif
        </div>

        <div class="card-body">
            <h3 class="text-center">{{ $discussion->title }}</h3>
            <p>
                {!! Markdown::convertToHtml( $discussion->content ) !!}
            </p>

            @if($best_answer)
                <hr>
                <h3 class="text-center"> Best answer</h3>
                <div class="text-center" style="padding: 20px;">
                    <div class="card table-success">
                        <div class="card-header list-group-item-success align-content-sm-center" >
                            <img src="{{ $best_answer->user->avatar }}" width="50px" height="50px" style="border-radius: 50%"> &nbsp;&nbsp;
                            {{ $best_answer->user->name }}
                        </div>

                        <div class="card-body">
                            {{ $best_answer->content }}
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="card-footer col-sm-auto" >
            {{ $discussion->replies->count() }} replies
            <a href="{{ route('channel',['slug' => $discussion->channel->slug]) }}" class="btn btn-sm btn-outline-secondary float-md-right">{{ $discussion->channel->title }}</a>
        </div>
    </div>
    <br>

    @foreach($discussion->replies as $reply)
        <div class="card">
            <div class="card-header">
                <img src="{{ $reply->user->avatar }}" width="50px" height="50px" style="border-radius: 50%"> &nbsp;&nbsp;
                {{ $reply->user->name }}

                @if(!$best_answer)
                    @if(Auth::id() == $discussion->user->id)
                        <a href="{{ route('reply.best_answer',['id' => $reply->id]) }}" class="btn btn-sm btn-primary float-md-right">Mark as best answer</a>
                    @endif
                @endif

                @if(Auth::id() == $reply->user->id)
                    @if(!$reply->best_answer)
                        <a href="{{ route('discussion.reply.edit',['id' => $reply->id]) }}" class="btn btn-primary float-md-right btn-sm" style="margin-right: 10px">Edit</a>
                    @endif
                @endif
            </div>

            <div class="card-body">
                <p>
                    {{ $reply->content }}
                </p>
            </div>

            <div class="card-footer">
                @if($reply->is_liked_by_auth_user()) {{--If reply is Liked by current user--}}
                    <a href="{{ route('reply.unlike',['id' => $reply->id]) }}" class="btn btn-danger btn-sm"><span class="badge">{{ $reply->likes->count() }}</span>Unlikes</a>
                @else {{--if reply is not liked by current user--}}
                    <a href="{{ route('reply.like',['id' => $reply->id]) }}" class="btn btn-success btn-sm"><span class="badge">{{ $reply->likes->count() }}</span> Likes </a>&nbsp;
                @endif
            </div>
        </div>
        <br>
    @endforeach

    @auth()
        <div class="card card-default">
            <div class="card-body">
                <form action="{{ route('discussion.reply.store',['id' => $discussion->id]) }}" method="post">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="reply">Leave a Reply...</label>
                        <textarea name="reply" id="reply" cols="30" rows="10" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <button class="btn float-md-right" type="submit">Leave a Reply</button>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="card card-body text-center">
            <h3>Sign in to Reply</h3>
        </div>
        <br>
    @endauth
@endsection
