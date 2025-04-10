<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Repositories\TaskRepositoryInterface;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Requests\ChangeStatusRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function index(Request $request) {
        return response()->json(['data'=>$this->taskRepository->all($request->user()->id)]);
    }

    public function store(StoreTaskRequest $request) {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        return response()->json(['data'=>$this->taskRepository->store($data)], 200);
    }

    public function update(UpdateTaskRequest $request, $id) {
         // Check if task exists (if not, it will automatically trigger a 404 if using route model binding)
         $task = Task::where('id',$id)->first();
         if (!$task) {
        return response()->json(['message' => 'Task not found'], 404);
    }

        return response()->json(['data'=>$this->taskRepository->update($task, $request->validated())]);
    }

    public function destroy($id) {
        $task = Task::where('id',$id)->first();
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        $this->taskRepository->delete($task);
        return response()->json(['message' => 'task deleted'], 200);
    }
}
