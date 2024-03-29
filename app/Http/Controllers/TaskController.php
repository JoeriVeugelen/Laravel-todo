<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('todos.index', [
            'tasks' => Task::with('user')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $todo = new Task();
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->user_id = auth()->id();
        $todo->save();

        return redirect('/todos');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = Task::find($id);
        return view('todos.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $task = Task::find($id);
        $task->title = $validatedData['title'];
        $task->description = $validatedData['description'];
        $task->save();

        return redirect('/todos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();

        return redirect('/todos');
    }

    public function toggleDone(Task $task)
    {
        $task->done = !$task->done;
        $task->save();

        return back();
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        if ($query == 'done') {
            $tasks = Task::where('done', 1)->get();
        } elseif ($query == 'not done') {
            $tasks = Task::where('done', 0)->get();
        } else {
            $tasks = Task::where('title', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%")
                ->get();
        }
        return view('todos.index', ['tasks' => $tasks]);
    }
}
