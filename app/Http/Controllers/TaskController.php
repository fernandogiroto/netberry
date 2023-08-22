<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Exception;
use App\Http\Requests\TaskRequest;
use Debugbar;


class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('category')->with('user')->paginate(3);
        return Inertia::render('Dashboard', [
            'categorys' => Category::all(),
            'tasks' => $tasks
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'task_name' => 'required',
            'task_category' => 'required',
        ]);

        $task = Task::create([
            'name' => $request->task_name,
            'user_id' => $request->user()->id,
            'created_at' => Carbon::now(),
            'category_id' => $request->task_category
        ]);

        sleep(1);

        return redirect()->route('dashboard')->with('message', 'Task Created Successfully');
    }

    public function update(Request $request)
    {

        $request->validate([
            'task_name' => 'required',
            'task_category' => 'required',
            'task_id' => 'required'
        ]);

        $task = Task::findOrFail($request->task_id);
        $taskCategoryId = gettype($request->task_category) != 'string' ? $request->task_category : $task->category_id;


        $task->update([
            'name' => $request->task_name,
            'category_id' => $taskCategoryId
        ]);
        return redirect()->back()->with('success', 'Task updated successfully');
    }

    public function complete(Request $request)
    {
        try {
            $taskStatus = !filter_var($request->done, FILTER_VALIDATE_BOOLEAN);
            $task = Task::findOrFail($request->id);
            $task->update([
                'done' => $taskStatus,
            ]);
            return redirect()->back()->with('success', 'Task updated successfully');
        } catch (Exception $e) {
            Debugbar::addThrowable($e);
        }
    }

    public function destroy(Request $request)
    {
        $task = Task::findOrFail($request->id);
        $task->delete();
        return redirect()->back()->with('success', 'Task updated successfully');
    }
}
