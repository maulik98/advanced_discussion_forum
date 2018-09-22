@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Channels
            <a href="/channels/create" class="btn btn-sm btn-outline-primary float-md-right" >Create new Channel</a>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <th>
                        Name
                    </th>
                    <th>
                        Edit
                    </th>
                    <th>
                        Delete
                    </th>
                    @foreach($channels as $channel)
                        <tr>
                            <td>{{ $channel->title }}</td>
                            <td>
                                <a href="{{ route('channels.edit',['channel' => $channel->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                            </td>
                            <td>
                                <input class="btn btn-sm btn-danger" value="Delete" type="button" onclick="channelDelete({{ $channel->id }},this)">
                            </td>
                        </tr>
                    @endforeach
                </thead>
            </table>
        </div>
    </div>

    <script>
        function channelDelete(id,element)
        {
            $.ajax({
                type: "GET",
                url: '{{ route('channel.delete') }}',
                data: {id: id},
                success: function (msg)
                {
                    alert('Channel deleted');
                    $(element).parent().parent().remove();
                }
            });
        }
    </script>
@endsection