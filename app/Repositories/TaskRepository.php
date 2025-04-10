<?php
// app/Repositories/TaskRepository.php
namespace App\Repositories;

use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{

    public function all($userId)
    {
        $tasks = Task::where('user_id', $userId)->get(); // Get tasks by user

        // Return a collection of TaskResource
        return TaskResource::collection($tasks);
    }

    public function store(array $data)
    {
        $task = Task::create($data); // Create new task

        // Return a TaskResource
        return new TaskResource($task);
    }

    public function update($task, array $data)
    {
        $task->update($data); // Update existing task

        // Return the updated task as a TaskResource
        return new TaskResource($task);
    }

    public function delete($task)
    {
        return $task->delete();
    }

    
}
