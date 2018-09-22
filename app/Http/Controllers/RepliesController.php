<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Like;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit($id)
    {
        $reply = Reply::find($id);
        return view('replies.edit',compact('reply'));
    }

    public function update($id,Request $request)
    {
        $this->validate($request,[
            'reply' => 'required'
        ]);
        $reply = Reply::find($id);
        $reply->content = $request->reply;
        $reply->update();

        Session::flash('success','Reply Updated');
        return redirect()->back();
    }

    public function like($id)
    {
        Like::create([
            'reply_id' => $id,
            'user_id' => Auth::id(),
        ]);

        Session::flash('success','You liked this reply');
        return redirect()->back();
    }

    public function unlike($id)
    {
        $like = Like::where('reply_id',$id)->where('user_id',Auth::id())->first();
        $like->delete();

        Session::flash('success','You unliked this reply');
        return redirect()->back();
    }

    public function best_answer($id)
    {
        $reply = Reply::find($id);
        $reply->best_answer = 1;
        $reply->save();

        Session::flash('success','You marked this reply as best answer');

        return redirect()->back();
    }
}
