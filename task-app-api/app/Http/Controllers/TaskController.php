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
        $tasks = Task::all();
        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'completed' => 'boolean',
        ]);
        $task = Task::create([
            'name' => $request->name,
        ]);

        return $task;
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return $task;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'completed' => 'boolean',
        ]);

        $task->update([
            'name' => $request->name,
            'completed' => $request->completed,
        ]);

        //Preparar mensaje
        $message = "Actualizado con éxito";

        return response()->json([
            "message" => $message,
            "task" => $task
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json([
            "message" => "Eliminada con éxito",
            "task" => $task
        ]);
    }
}
