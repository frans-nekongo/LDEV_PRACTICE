<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

new class extends Component {
    public array $internalTasks = []; 

    public function mount(): void
    {
        $this->loadTasksInternally();
    }

    public function loadTasksInternally(): void
    {
        \Log::info('Attempting to load tasks internally from /api/tasks.');
        try {
            $request = Request::create('/api/tasks', 'GET');
            $response = Route::dispatch($request);

            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getContent(), true);
                if (is_array($data)) {
                    $this->internalTasks = $data;
                    $this->internalTasks = [...$this->internalTasks]; // Force a property change?
                    \Log::info('Successfully loaded tasks internally from /api/tasks.', ['tasks' => $data]);
                } else {
                    \Log::error('Internal API response from /api/tasks was not a valid JSON array.');
                }
            } else {
                \Log::error('Failed to load tasks internally from /api/tasks.', ['status' => $response->getStatusCode(), 'body' => $response->getContent()]);
            }
        } catch (\Exception $e) {
            \Log::error('Error loading tasks internally from /api/tasks:', ['error' => $e->getMessage()]);
        }
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.task');
    }
}

; ?>

<div>
    <button wire:click="loadTasksInternally">View Tasks</button>

    <div>
        <h3>Tasks Loaded via Internal API Call</h3>
        @if ($internalTasks)
            <ul>
                @foreach ($internalTasks as $task)
                    <li>ID: {{ $task['id'] ?? 'N/A' }}</li>
                    <li>Title: {{ $task['title'] ?? 'No Title' }}</li>
                    <li>Description: {{ $task['description'] ?? 'No Description' }}</li>
                    <li>Status: {{ $task['status'] ?? 'N/A' }}</li>
                    <li>Due Date: {{ $task['due_date'] ?? 'N/A' }}</li>
                    <li>Created At: {{ $task['created_at'] ?? 'N/A' }}</li>
                    <li>Updated At: {{ $task['updated_at'] ?? 'N/A' }}</li>
                    <br>
                @endforeach
            </ul>
        @else
            <p>No tasks loaded via internal API call yet.</p>
        @endif
    </div>
</div>
