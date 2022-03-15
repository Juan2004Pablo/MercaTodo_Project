<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Observers\ModelObserver;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()//: view
    {
        /*$users = User::paginate();

        return view('admin.user.index', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * $users->perPage()); */

        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function show($id) //: view
    {
        $user = User::find($id);

        return view('admin.user.show', compact('user'));
    }

    public function edit(User $user) //: view
    {
        return view('admin.user.update', compact('user'));
    }
 
    /*
    public function edit($id) //: view
    {
        $user = User::find($id);

        return view('admin.user.update')-> with('user', $user);
    }*/

    
    public function update(Request $request, $id)
    {
        $user=User::findOrFail($id);
        $data = $request->only('name', 'email', 'role');
        
        $user->update($data);
        return redirect()->back()->with('success', 'User updated successfully');
    }
        /*
        $user = User::find($user->id);
        $user->name = Input::get('name');
        $user->email = Input::get('email');
        $user->role = Input::get('role');
        $user->save();

        return redirect::to('users')->with('success', 'User updated successfully');
    }*/
    /*
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

    //public function update(Request $request, $id)//: redirect
        //{
            /*$user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->save();
            
            return redirect()->route('users.index')
            ->with('success', 'User updated successfully');*/
            /*
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

    public function toggle(User $user)//: redirect
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