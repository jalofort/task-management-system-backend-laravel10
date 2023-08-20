<?php

namespace App\Http\Services\Task;

use App\Models\Task;

class TaskService
{
    public function __construct()
    {
    }

    public function view($id)
    {
        $task = Task::with(['group', 'creator'])->find($id);
        if (!$task)
            return response(['message' => 'Task not found'], 404);

        return $task;
    }

    public function store($title, $description, $groupID, $userID)
    {
        $task = Task::create([
            'title' => $title,
            'description' => $description,
            'group_id' => $groupID,
            'created_at' => time(),
            'created_by' => $userID,
        ]);

        if ($task)
            return response(['message' => 'Created'], 201);

        return response(['message' => 'Internal server error'], 500);
    }

    public function update($id, $params)
    {
        $task = Task::find($id);
        if (!$task)
            return response(['message' => 'Task no found'], 404);

        if (isset($params['title']))
            $task->title = $params['title'];
        if (isset($params['groupID']))
            $task->group_id = $params['groupID'];
        if (isset($params['description']))
            $task->description = $params['description'];
        if (isset($params['isCompleted']))
            $task->is_completed = $params['isCompleted'];

        if (!$task->save())
            return response(['message' => 'Internal server error'], 500);

        return response()->noContent();
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        if (!$task)
            return response(['message' => 'Task no found'], 404);

        if (!$task->delete())
            return response(['message' => 'Internal server error'], 500);

        return response()->noContent();
    }
}
