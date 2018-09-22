<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class DiscussionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('discuss');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'channel_id' => 'required',
            'contents' => 'required',
        ]);

        Discussion::create([
            'user_id' => Auth::id(),
            'channel_id' => $request->channel_id,
            'title' => $request->title,
            'content' => $request->contents,
            'slug' => str_slug($request->title)
        ]);

        Session::flash('success','You created new Discussion');

        return redirect()->back();
    }

    public function show($id,$slug)
    {
        $discussion = Discussion::where('id',$id)->where('slug',$slug)->first();
        $best_answer = $discussion->replies()->where('best_answer',1)->first();
        return view('discussion.show',compact('discussion','best_answer'));
    }

    public function reply_store($id,Request $request)
    {
        $this->validate($request,[
           'reply' => 'required'
        ]);
        $discussion = Discussion::find($id);

        $reply = Reply::create([
           'user_id' => Auth::id(),
            'discussion_id' => $id,
            'content' => $request->reply
        ]);

        Session::flash('success','You replied this discussion');

        return redirect()->back();
    }

    public function edit($id,$slug)
    {
        $discussion = Discussion::where('id',$id)->where('slug',$slug)->first();
        return view('discussion.edit',compact('discussion'));
    }

    public function update($id,$slug,Request $request)
    {
        $this->validate($request,[
           'contents' => 'required'
        ]);
        $discussion = Discussion::find($id);
        $discussion->content = $request->contents;
        $discussion->update();

        Session::flash('success','Discussion Updated');
        return redirect()->route('forum.view',['id' => $discussion->id, 'slug' => $discussion->slug]);
    }

    public function destroy($id)
    {
        Discussion::destroy($id);
        Session::flash('success','You successfully deleted discussion');
        return redirect('forum?filter=me')  ;
    }
}
