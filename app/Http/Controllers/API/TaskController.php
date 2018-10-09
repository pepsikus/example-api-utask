<?php

namespace App\Http\Controllers\API;

// use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest as Request;
use App\Http\Controllers\Controller;
use App\Task;
use App\Http\Resources\TaskResource;
//use \Carbon\Carbon;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::with('user')->paginate(10);

        return TaskResource::collection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = Task::create($request->all());

        return (new TaskResource($task))
            ->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);

        return (new TaskResource($task))
            ->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $task->update($request->only(['name', 'description']));

        return (new TaskResource($task))
            ->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        $task->delete();

        return response()->json(null, '204');
    }


    /**
     * Completing the task
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function complete(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $now = new \DateTime();
        $task->update([
            'completed_at' => $now
        ]);

        return (new TaskResource($task))
            ->response()->setStatusCode(200);
    }

}
