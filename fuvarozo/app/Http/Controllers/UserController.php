<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use App\Models\Vehicle;
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
            'name' => 'Józsi',
            'email' => 'jozsi@j.com',
            'password' => bcrypt('Jozsi'),
            'role' => 'driver',
        ]);

        User::create([
            'name' => 'Sanyi',
            'email' => 'sanyi@j.com',
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

        $userId = $user -> id; 
        $jobs = Task::where('driver_id', $userId)->get();
        $data = [
            'user' => $user,
            'jobs' => $jobs
        ];
        return view('driverjobs', $data);
    }

    public function logout(){
        auth() -> logout();
        return redirect('/');
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
        
        return back()->withErrors(['login' => 'Invalid credentials.']);
    }

    public function adminview(Request $request)
    {
        $user = auth()->user();
        $drivers = User::where('role', 'driver')->get();
        $jobs = Task::all();
        $vehicles = Vehicle::all();
        $data = [
            'user' => $user,
            'jobs' => $jobs,
            'drivers' => $drivers,
            'vehicles' => $vehicles
        ];
        return view('adminjobs', $data);
    }

    public function driverview(Request $request)
    {
        $user = auth()->user();
        $jobs = Task::where('driver_id', $user -> id) -> get();
        $vehicles = Vehicle::where('driver_id', $user -> id) -> get();
        $data = [
            'user' => $user,
            'jobs' => $jobs,
            'vehicles' => $vehicles
        ];
        return view('driverjobs', $data);
    }
}
