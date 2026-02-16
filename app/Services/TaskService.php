<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    public function index()
    {
        return Task::latest(20)->get();
    }
    public function create()
    {
        return view('admin.tasks.create');
    }
    public function store($request)
    {
        return Task::create($request->all());
    }

    public function edit($task)
    {
        return view('admin.tasks.edit', compact('task'));
    }

    public function update($request, $task)
    {
        return $task->update($request->all());
    }

    public function destroy($task)
    {
        return $task->delete();
    }
}