<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function admin(){
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Jozsi',
            'email' => 'jozsi@j.com',
            'password' => bcrypt('Jozsi'),
            'role' => 'driver',
        ]);

        User::create([
            'name' => 'Sanyi',
            'email' => 'sanyi@s.com',
            'password' => bcrypt('Sanyi'),
            'role' => 'driver',
        ]);
    }
    public function register(Request $request){
        $fields = $request -> validate([
            'name' => ['required', 'min:4', 'max:30', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email'), 'min:3'],
            'password' => ['required', 'min:8', 'max:30'],
            'role' =>['']
        ]);

        $fields['password'] = bcrypt($fields['password']);
        $user = User::create($fields);
        auth() -> login($user);

        return view('driverjobs');
    }

    public function login(Request $request){
        $fields = $request -> validate([
            'loginname' => 'required',
            'loginpassword' => 'required'
        ]);

        if (auth() -> attempt(['name' => $fields['loginname'], 'password' => $fields['loginpassword']])) {
            $request -> session() -> regenerate();
            $user = auth()->user();

            if($user -> role == 'admin'){
                return redirect('/adminview');
            }
            else{
                return redirect('/driverview');
            }
        }
    }

    public function adminview(Request $request)
    {
        return view('adminjobs');
    }

    public function driverview(Request $request)
    {
        return view('driverjobs');
    }
}
