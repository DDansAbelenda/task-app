<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::latest()->get();
        return view('task.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Task::create([
            'name' => $request->name,
            'completed' => false,
        ]);

        return redirect()->route('task.index')->with('success', 'Tarea creada exitosamente.');
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update([
            'completed' => !$task->completed,
        ]);

        //Preparar mensaje
        $message = "";
        if ($task->completed) {
            $message = 'Tarea "'.$task->name.'" completada ';
        } else {
            $message = 'Tarea "'.$task->name.'" aún no completada';
        }
        return redirect()->route('task.index')->with('success', $message);
    }


    public function destroy($id)
    {
        $task = Task::findOrFail($id); // se guarda el objeto con id = $id
        $task->delete();

        return redirect()->route('task.index')->with('success', 'Tarea "'.$task->name.'" eliminada exitosamente.');
    }

    public function show($id){
        $task = Task::findOrFail($id);
        return view('task.detail')->with('task', $task);
    }
}
