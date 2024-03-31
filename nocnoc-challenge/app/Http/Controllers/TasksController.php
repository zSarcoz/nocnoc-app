<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;
use Inertia\Response;
use App\Http\Requests\TaskRequest;
use App\Models\User;
use Illuminate\Console\View\Components\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $tasks = Tasks::paginate(20);
       return inertia("Tasks/Index",['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return inertia("Tasks/Create",['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param App\Http\Requests\TaskRequest
     * @return \Illuminate\Http\Response
     */

    public function store(TaskRequest $request)
    {
        Tasks::create($request->validated());
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tasks $task)
    {
        return inertia("Tasks/Edit", ["task"=> $task]);
    }

    /**
     * Update the specified resource in storage.
    * @param App\Http\Requests\TaskRequest $request
    * @param Tasks $task
    * @return \Illuminate\Http\Response
    */
    public function update(TaskRequest $request, Tasks $task)
    {
        $task->update($request->validated());
        return redirect()->route("tasks.index");
    }

    /**
     * Remove the specified resource from storage.
     * @param Tasks $task
    * @return \Illuminate\Http\Response
     */
    public function destroy(Tasks $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
