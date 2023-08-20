<?php

namespace App\Http\Controllers;

use App\Http\Services\Group\GroupService;
use App\Http\Requests\Group\StoreGroupRequest;
use App\Http\Requests\Group\UpdateGroupRequest;

class GroupController extends Controller
{
    public function __construct(protected GroupService $groupService)
    {
    }

    public function find($searchValue)
    {
        return $this->groupService->find($searchValue);
    }

    public function index()
    {
        return $this->groupService->index();
    }

    public function store(StoreGroupRequest $request)
    {
        return $this->groupService->store(
            $request->validated('name')
        );
    }

    public function update(UpdateGroupRequest $request, $id)
    {
        return $this->groupService->update(
            $id,
            $request->validated('name')
        );
    }

    public function destroy($id)
    {
        return $this->groupService->destroy($id);
    }
}
