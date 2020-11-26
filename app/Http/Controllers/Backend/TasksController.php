<?php

namespace App\Http\Controllers\Backend;

use App\Task;
use Illuminate\Http\Request;
use Shahnewaz\Redprint\Traits\CanUpload;
use App\Http\Requests\Backend\TaskRequest;
use App\Http\Controllers\Controller;

class TasksController extends Controller
{
    use CanUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tasks = Task::withTrashed();
        
		if ($request->has('description')) {
			$tasks = $tasks->where('description', 'LIKE', '%'.$request->get('description').'%');
		}
        $tasks = $tasks->paginate(20);
        return view('backend.tasks.index')->with('tasksData', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form(Task $task = null)
    {
        $task = $task ?: new Task;
        return view('backend.tasks.form')->with('task', $task);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post(TaskRequest $request, Task $task)
    {
        $task = Task::firstOrNew(['id' => $request->get('id')]);
        $task->id = $request->get('id');
		$task->description = $request->get('description');
		$task->state = $request->get('state');
		$task->user_id = $request->get('user_id');

        $task->save();

        $message = trans('redprint::core.model_added', ['name' => 'task']);
        return redirect()->route('task.index')->withMessage($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Task $task)
    {
        $task->delete();
        $message = trans('redprint::core.model_deleted', ['name' => 'task']);
        return redirect()->back()->withMessage($message);
    }

    /**
     * Restore the specified deleted resource to storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($taskId)
    {
        $task = Task::withTrashed()->find($taskId);
        $task->restore();
        $message = trans('redprint::core.model_restored', ['name' => 'task']);
        return redirect()->back()->withMessage($message);
    }

    public function forceDelete($taskId)
    {
        $task = Task::withTrashed()->find($taskId);
        $task->forceDelete();
        $message = trans('redprint::core.model_permanently_deleted', ['name' => 'task']);
        return redirect()->back()->withMessage($message);
    }
}
