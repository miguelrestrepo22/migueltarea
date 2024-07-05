<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tasks' => 'required|string|min:3|max:100',
            'date' => 'required|date_format:Y-m-d H:i:s'
        ]);
        $date = $request->input('date');
        Task::create([
            'tasks' => $request->input('tasks'),
            'created_at' => $date,
            'updated_at' => $date
        ]);

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
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tasks' => 'required|string|min:3|max:100',
            'date' => 'required|date_format:Y-m-d H:i:s'
        ]);

        $date = $request->input('date');

        $task = Task::findOrFail($id);

        $task->update([
            'tasks' => $request->input('tasks'),
            'created_at' => $date,
            'updated_at' => $date
        ]);

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Task::findOrFail($id);
        $student->delete();

        return redirect()->route('tasks.index');
    }
}
