<?php

namespace App\Http\Controllers\API;

// use Illuminate\Http\Request;
use App\Http\Requests\UserRequest as Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Resources\UserResource;
use App\Http\Resources\TaskResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge([
            'password' => bcrypt($request->input('password')),
            'remember_token' => str_random(10)
        ]);
        $user = User::create($request->all());

    //    return new UserResource($user);
        return (new UserResource($user))
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
        $user = User::findOrFail($id);

        return (new UserResource($user))
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
        $user = User::findOrFail($id);

        $emailOld = $user->email;
        $user->update($request->only(['first_name', 'last_name', 'email']));

        if ($request->email != $emailOld) {
            $user->update([ 'email_verified_at' => null ]);
        }

        return (new UserResource($user))
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
        $user = User::findOrFail($id);

        $user->tasks()->delete();
        $user->delete();

        return response()->json(null, '204');
    }

    /**
     * Get user tasks
     * GET /api/users/{user}/tasks
     *
     * @param  User   $user
     * @return TaskResource[] - collection of TaskResources
     */
    public function tasks(User $user)
    {
        return TaskResource::collection($user->tasks);
    }


    /**
     * Verify user email
     * PUT /api/users/{user}/verify_email
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verifyEmail(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $now = new \DateTime();
        $user->update([
            'email_verified_at' => $now
        ]);

        return (new UserResource($user))
            ->response()->setStatusCode(200);
    }

}
