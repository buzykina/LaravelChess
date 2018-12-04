<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use app\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class UserController extends Controller
{
    /**
     * Show the form for editing the user's settings.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        //guard - only the user themself or admin can edit

        if($this->user->admin || $this->user->id == $id )
        {
            $account = User::find($id);
            return view('user.edit')->with(compact('account'));
        }
        throw new PermissionDenied();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditUserRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
		$user = User::findOrFail($id);

        $user->email = $request->email;
        $user->name = $request->uname;
		
		$img = $request->file('image');
		if($img){
			$request->validate([
				'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			]);
			
			$path=$img->store('profilePics');
			$user->imgUrl = $path;
		}
        $user->save();

        //flash()->success("Your changes to your account have been saved",'Saved:');
        //return redirect()->route('pages.profile');
		return redirect('/profile');
    }
}
