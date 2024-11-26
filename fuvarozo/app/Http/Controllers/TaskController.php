<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function create(Request $request)
    {
        $fields = $request -> validate([
            'starting_address' => ['required'],
            'ending_address' => ['required'],
            'person_name' => ['required'],
            'phone_number' => ['required'],
            'driver_id' =>['']
        ]);

        $job = Task::create($fields);
        return redirect('/adminview');
    }

    public function edit(Request $request)
    {
        $job = Task::findOrFail($request -> id);

        $request->validate([
            'starting_address' => 'required',
            'ending_address' => 'required',
            'person_name' => 'required',
            'phone_number' => 'required',
        ]);

        $job->update($request->all());
        return redirect('/adminview');
    }

    public function delete(Request $request)
    {
        $job = Task::findOrFail($request -> id);
        $job->delete();

        return redirect('/adminview');
    }

    public function assignDriver(Request $request)
    {
        $job = Task::findOrFail($request -> id);
        $job->update(['driver_id' => $request->driver_id]);

        return redirect('/adminview');
    }

    public function status(Request $request){
        $job = Task::findOrFail($request -> id);
        $job->update(['status' => $request -> status]);

        return redirect('/driverview');
    }

    public function editview(Request $request)
    {
        $user = auth()->user();
        $job = Task::findOrFail($request -> id);
        $data = [
            'user' => $user,
            'job' => $job
        ];
        return view('editjob', $data);
    }
}
