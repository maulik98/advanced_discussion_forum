<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function edit()
    {
        $user = User::find(Auth::user()->id);
        return view('user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $user = User::find($id);
        $this->validate($request,[
            'name' =>'required',
            'email' => 'required',
            'password' => 'confirmed',
            'avatar' => 'image'
        ]);
        $data = $request->all();
        $data['password'] = Hash::make($request->get('password'));
        $user->update($data);
        if ($request->has('avatar'))
        {
            $image = $request->file("avatar");
            $destinationPath = public_path() . '/avatar/';

            $fileName = $image->getClientOriginalName();
            /*$extension = $image->getClientOriginalExtension();
            $storeName = $fileName . '.' . $extension;*/

            // Store the file in the disk
            $image->move($destinationPath, $fileName);
            $image = User::find($id);
            $image->avatar = $destinationPath.$fileName;
            $image->update();

        }
        return redirect('forum');
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
}
