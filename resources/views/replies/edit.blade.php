@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="card">
            <div class="card-header">Edit Reply</div>
            <div class="card-body">
                <form action="{{ route('discussion.reply.update',['id' => $reply->id]) }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <lable for="content" class="text-right">Leave a Reply:</lable>
                        <textarea name="reply" value="reply" id="reply" cols="30" rows="10" class="form-control col-md-11">{{ $reply->content }}</textarea>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-success float-md-right" type="submit">Update Reply</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
