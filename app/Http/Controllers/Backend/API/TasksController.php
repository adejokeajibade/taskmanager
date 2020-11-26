<?php

namespace App\Http\Controllers\Backend\API;

use App\Task;
use Illuminate\Http\Request;
use Shahnewaz\Redprint\Traits\CanUpload;
use App\Http\Requests\Backend\TaskRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\Task as TaskResource;
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
        $tasks = Task::with('taskUsers')->get();
        
		if ($request->has('description')) {
			$tasks = $tasks->where('description', 'LIKE', '%'.$request->get('description').'%');
		}
        
        return (new TaskCollection($tasks));
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

        $responseCode = $request->get('id') ? 200 : 201;
        return response()->json(['saved' => true], $responseCode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $task = Task::find($request->get('id'));
        $task->delete();
        return response()->json(['no_content' => true], 200);
    }

    /**
     * Restore the specified resource to storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request)
    {
        $task = Task::withTrashed()->find($request->get('id'));
        $task->restore();
        return response()->json(['no_content' => true], 200);
    }
}
