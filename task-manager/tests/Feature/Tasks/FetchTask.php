<?php

use function Pest\Laravel\getJson;
use \Illuminate\Support\Facades\Http;
use App\Models\Task;



//it('Gets all tasks in the database', function () {
//    $response = Http::get('https://books-api.com/books');
//
//    expect($response->json())->toEqual('??? what goes here ???');
//
//});

//test('get task', function () {
//    $task = Task::all()->random();
//});

test('create task', function () {
//    $task = Task::factory()->make();
    $task = Task::factory()->create([
        'status'=>'completed'
    ]);

    expect($task)->toBeInstanceOf(Task::class)
        ->and($task->status)->toBe('completed');
});

/**
 * Tests should encompass these areas either in a single line or many
 * Front end
 * Back end
 * Database
 * Routes
 */
