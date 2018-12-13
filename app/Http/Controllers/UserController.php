<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use app\User;
use Image;
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
            $imageName = $img->hashName();
            $directory = public_path('storage/profilePics/');
            $directoryP = public_path('storage/pixelate/');
            $directoryC = public_path('storage/circled/');
            $imageUrl = $directory.$imageName;
            $pixelateUrl = $directoryP.$imageName;
            $circledUrl = $directoryC.$imageName;
            $width = 300;
            $height = 300;
            $img1 = Image::make($img);
            $img1->resize($width, $height) -> save($imageUrl);
            $canvas = Image::canvas($width,$height);
            $canvas -> insert($imageUrl,'center');
            for($i = 0; $i < $height;$i++)
            {
                for($g = 0; $g < $width;$g++)
                {
                    $r = $width/2;
                    if(pow($r - $i,2) + pow($r - $g,2)>pow($r,2))
                    {
                        $canvas->pixel("0000",$g,$i);
                    }
                }
            }
            $canvas->save($imageUrl);
            $img1->pixelate(12)->save($pixelateUrl);
            $user->imgUrl = '/'.$imageName;
		}
        $user->save();

        //flash()->success("Your changes to your account have been saved",'Saved:');
        //return redirect()->route('pages.profile');
		return redirect('/profile');
    }


}
