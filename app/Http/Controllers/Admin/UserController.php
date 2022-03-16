<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Products\UserRequest;
use DB;
use App\Observers\ModelObserver;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::find($id);

        return view('admin.user.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.update', compact('user'));
    }
 
    public function update(UserRequest $request, User $user)
    {
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->role = $request->get('role');

        $user->save();
        
        return redirect(route('users.show', $user));
    }

    public function toggle(User $user)
    {
        $user->disable_at = $user->disable_at ? null : now();

        $user->save();

        if ($user->disable_at === null)
        {
            \Log::warning('enabled user account with id: '.$user->id);
        } else{
            \Log::warning('disabled user account with id: '.$user->id);
        }

        return redirect()->back();
    }

}