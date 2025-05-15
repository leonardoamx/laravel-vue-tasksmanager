<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResponse
    {
        return response()->json(
            Task::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):JsonResponse
    {
        $task = new Task($request->all());
        $task->save();
        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):JsonResponse
    {
        try {
            $task = Task::findOrFail($id);
            return response()->json($task);
        } catch(ModelNotFoundException $e) {
            return response()->json([
                "message" => "Task not found"
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id):JsonResponse
    {
        try {
            $task = Task::findOrFail($id);
            $task->update($request->all());
            return response()->json($task);
        } catch(ModelNotFoundException $e) {
            return response()->json([
                "message" => "Task not found"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):JsonResponse
    {
        try {
            $task = Task::findOrFail($id);
            $task->delete();
            return response()->json([
                'message' => 'Task deleted'
            ]);
        } catch(ModelNotFoundException $e) {
            return response()->json([
                "message" => "Task not found"
            ], 404);
        }
    }
}
