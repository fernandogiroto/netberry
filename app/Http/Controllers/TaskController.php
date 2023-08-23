<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Support\Facades\Exception;

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
        try {
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
            return response()->json([
                'message' => 'Task Created successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'An error occurred while updating the task',
                'exception' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {
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
            return redirect()->back()->with('success', 'Task updated successfully.');
        } catch (Exception $e) {
            return response()->json([
                'error' => 'An error occurred while deleting the task',
                'exception' => $e->getMessage(),
            ], 500);
        }
    }


    public function destroy(Request $request)
    {
        try {
            $task = Task::findOrFail($request->id);
            $task->delete();

            return response()->json([
                'message' => 'Task deleted successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'An error occurred while deleting the task',
                'exception' => $e->getMessage(),
            ], 500);
        }
    }

    public function complete(Request $request)
    {
        try {
            $taskStatus = !filter_var($request->done, FILTER_VALIDATE_BOOLEAN);
            $task = Task::findOrFail($request->id);
            $task->update([
                'done' => $taskStatus,
            ]);
            return response()->json([
                'message' => 'Task updated successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'An error occurred while updating the task',
                'exception' => $e->getMessage(),
            ], 500);
        }
    }
}
