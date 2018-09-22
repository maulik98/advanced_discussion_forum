<?php

namespace App\Http\Controllers;

use App\Discussion;
use Illuminate\Http\Request;
use App\Channel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class ChannelsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('channels.index')->with('channels',Channel::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('channels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'channel' => 'required'
        ]);

        Channel::create([
            'title' => $request->channel,
            'slug' => str_slug($request->channel)
        ]);

        Session::flash('success','Channel created Successfully');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $channel = Channel::find($id);
        return view('channels.edit',compact('channel'));
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
        $this->validate($request,[
            'channel' => 'required'
        ]);

        $channel = Channel::find($id);
        $channel->title = $request->channel;
        $channel->slug = str_slug($request->channel);
        $channel->update();

        Session::flash('success','Channel Updated');

        return redirect('/channels');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $id = Input::get('id');
        $discussion = Discussion::where('channel_id',$id);
        $discussion->forceDelete();
        Channel::destroy($id);
    }
}
