<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use \Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use function Livewire\Volt\title;
use Illuminate\Support\Facades\Validator;


class TaskController extends Controller
{
    /**
     * GET /api/tasks → List all tasks
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    /**
     * POST /api/tasks → Create a new task
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {

        /**
         * validation example from docs
         * public function rules(): array
         * {
         * return [
         * 'title' => 'required|unique:posts|max:255',
         * 'body' => 'required',
         * ];
         * }
         *
         * dffrnt but imprntn
         * Rule::in(['first-zone', 'second-zone']),
         * */

        // way 1 from docs
        $task = new Task;

        $validator = Validator::make($request->all(),[
            'title' => 'required|max:255|min:3',
            'status'=> Rule::in(['completed', 'in_progress', 'pending']),
            'due_date' => 'date',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        else {
            $task->fill($request->all());
            $task->save();
            return response()->json($task);

        }
        //way 2 from docs , this is if
        // i have my functions in the
        // model file and just call them in here
        //learn how to use it
//        $task = Task::create([
//            'description' => $request->get('description'),
//        ]);
    }

    /**
     * GET /api/tasks/{id} → Retrieve a specific task
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse|string
    {
        $task = Task::query()->find($id);

        if($task === null) {
            return response("Task not found", 404);
        }

        return response()->json($task);
    }

    /**
     * PUT /api/tasks/{id} → Update a task
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse|string
    {
        $task = Task::query()->find($id);

        if($task === null) {
            return response("Task not found", 404);
        }

        $validator = Validator::make($request->all(),[
            'title' => 'required|max:255|min:3',
            'status'=> Rule::in(['completed', 'in_progress', 'pending']),
            'due_date' => 'date',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        else {
            $task->fill($request->all());
            $task->save();
            return response()->json($task);
        }
    }

    /**
     * DELETE /api/tasks/{id} → Delete a task
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): string
    {
        $tasks = Task::query()->find($id);
        if ($tasks != null) {
            $tasks->delete();
            return response("shits been done");
        }
        else return response("task not found fix yo sht");
    }
}
