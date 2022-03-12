<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$users = User::paginate();

        return view('admin.user.index', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * $users->perPage()); */

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

        return view('admin.user.update')-> with('user', $user);
    }

    /*
    public function update(Request $request, User $user)
    {
        request()->validate(User::$rules);

        $user->update($request->all());

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
        $data = request()->validate([
            'name' => '',
            'email' => '',
            'role' => '',
            'status' => '',
        ]);

        $user->update($data);

        return redirect('/admin/crudUsers/{user}' . $user->id);
    } */

    public function update(Request $request, $id)
        {
            /*$user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->save();
            
            return redirect()->route('users.index')
            ->with('success', 'User updated successfully');*/

            $data = request()->validate([
                'name' => '',
                'email' => '',
                'role' => '',
                'status' => '',
            ]);
    
            $user->update($data);
    
            return redirect('/admin/crudUsers/{user}' . $user->id)->with('success', 'User updated successfully');
        }
        /*
            $user->update($request->all());

    
            return redirect()->route('users.index')
                ->with('success', 'User updated successfully');
        }*/

    public function toggle(User $user)
    {
        $user->disable_at = $user->disable_at ? null : now();

        $user->save();
        return redirect()->back();
    }

}