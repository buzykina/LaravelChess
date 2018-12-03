<?php
<<<<<<< HEAD

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function update(EditUserRequest $request, $id)
    {

        $user = User::findOrFail($id);

        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();

        flash()->success("Your changes to your account have been saved",'Saved:');

        return redirect()->route('pages.profile');
    }

=======
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    
	 /* Update the given user.
     *
     * @param  Request  $request
     * @param  string  $id
     * @return Response
     */
    public function update(Request $request)
    {
		
    }
>>>>>>> a8dcc2a863aca926992730885f853bc7582727d7
}
