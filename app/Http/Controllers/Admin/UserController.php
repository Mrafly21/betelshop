<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create(){
        return view('admin.users.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:30'],
            'role_as' => ['required', 'integer'],
        ]);

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role_as' => $request['role_as'],
        ]);
        return redirect('/admin/users')->with('message', 'User Created Sucessfully');
    }

    public function edit($userId){
        $user = User::findorFail($userId);
        return view('admin.users.edit', compact('user'));
        // User::create([
        //     'name' => $request['name'],
        //     'email' => $request['email'],
        //     'password' => Hash::make($request['password']),
        //     'role_as' => $request['role_as'],
        // ]);
    }

    public function update(Request $request, $userId){
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'role_as' => ['required', 'integer'],
        ]);

        User::findOrFail($userId)->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role_as' => $request['role_as'],
        ]);
        return redirect('/admin/users')->with('message', 'User Edit Sucessfully');
    }

    public function destroy(int $userId){
        $user = User::findOrFail($userId);
        $user -> delete();
        return redirect('/admin/users')->with('message', 'User Delete Sucessfully');
    }

    public function passwordCreate(){
        return view('admin.users.change-password');
    }

    public function changePassword(Request $request){
        $request->validate([
            'current_password' => ['required','string','min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);
        if($currentPasswordStatus){

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('message','Password Updated Successfully');

        }else{

            return redirect()->back()->with('message','Current Password does not match with Old Password');
        }
    }
}
