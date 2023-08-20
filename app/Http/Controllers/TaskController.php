<?php

namespace App\Http\Controllers;

use App\Http\Services\Task\TaskService;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;

class TaskController extends Controller
{
    public function __construct(protected TaskService $taskService)
    {
    }

    public function view($id)
    {
        return $this->taskService->view($id);
    }

    public function store(StoreTaskRequest $request)
    {
        return $this->taskService->store(
            $request->validated('title'),
            $request->validated('description'),
            $request->validated('groupID'),
            $request->userID
        );
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        return $this->taskService->update(
            $id,
            $request->validated(),
        );
    }

    public function destroy($id)
    {
        return $this->taskService->destroy($id);
    }
}
