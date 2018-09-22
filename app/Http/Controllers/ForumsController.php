<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Discussion;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class ForumsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        switch (request('filter'))
        {
            case 'me';
                $discussions = Discussion::where('user_id',Auth::id())->paginate(3);
                break;

            case 'solved';
                $answered = array();
                foreach(Discussion::all() as $discussion)
                {
                    if ($discussion->hasBestAnswer())
                    {
                        array_push($answered,$discussion);
                    }
                }
                $discussions = new Paginator($answered,3);
                break;

            case 'unsolved';
                $unanswered = array();
                foreach(Discussion::all() as $discussion)
                {
                    if (!$discussion->hasBestAnswer())
                    {
                        array_push($unanswered,$discussion);
                    }
                }
                $discussions = new Paginator($unanswered,3);
                break;

            default;
                $discussions = Discussion::orderBy('created_at','DESC')->paginate(3);
                break;
        }


        return view('forum',compact('discussions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$slug)
    {
        $discussion = Discussion::where('id',$id)->where('slug',$slug)->first();
        $best_answer = $discussion->replies()->where('best_answer',1)->first();
        return view('discussion.show',compact('discussion','best_answer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function channel($slug)
    {
        $channel = Channel::where('slug',$slug)->first();
        $discussions = $channel->discussions;
        return view('channel',compact('discussions'));
    }
}
