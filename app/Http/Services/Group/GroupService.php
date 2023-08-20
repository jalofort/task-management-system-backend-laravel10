<?php

namespace App\Http\Services\Group;

use App\Models\Group;
use Illuminate\Support\Facades\DB;

class GroupService
{

    public function find($searchValue)
    {
        $groupTableQuery = DB::table('groups')->select('id')
            ->where('name', 'LIKE', '%' . $searchValue . '%');
        $groupsIDs = DB::table('tasks')->select('group_id AS id')
            ->where('title', 'LIKE', '%' . $searchValue . '%')
            ->orWhere('description', 'LIKE', '%' . $searchValue . '%')
            ->union($groupTableQuery)
            ->pluck('id')->toArray();

        return Group::with(['tasks' => function ($query) {
            $query->select('id', 'title', 'description', 'is_completed', 'group_id', 'created_at')
                ->orderBy('id', 'DESC');
        }])
            ->whereIn('id', $groupsIDs)
            ->orderBy('id', 'DESC')->get();
    }

    public function index()
    {
        return Group::with(['tasks' => function ($query) {
            $query->select('id', 'title', 'description', 'is_completed', 'group_id', 'created_at')->orderBy('id', 'DESC');
        }])->orderBy('id', 'DESC')->get();
    }

    public function store($name)
    {
        $group = Group::create([
            'name' => $name
        ]);

        if ($group)
            return response(['message' => 'Created'], 201);

        return response(['message' => 'Internal server error'], 500);
    }

    public function update($id, $name)
    {
        $group = Group::find($id);
        if (!$group)
            return response(['message' => 'Group no found'], 404);

        $group->name = $name;
        if (!$group->save())
            return response(['message' => 'Internal server error'], 500);

        return response(['message' => 'Updated'], 204);
    }

    public function destroy($id)
    {
        $group = Group::find($id);
        if (!$group)
            return response(['message' => 'Group no found'], 404);

        if (!$group->delete())
            return response(['message' => 'Internal server error'], 500);

        return response()->noContent();
    }
}
