<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskController extends Controller
{
    /**
     * GET /api/tasks → List all tasks
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    /**
     * POST /api/tasks → Create a new task
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * GET /api/tasks/{id} → Retrieve a specific task
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * PUT /api/tasks/{id} → Update a task
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * DELETE /api/tasks/{id} → Delete a task
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
