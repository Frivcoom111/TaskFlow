<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', User::class);

        $users = User::all();

        return response()->json([
            'users' => UserResource::collection($users),
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): JsonResponse
    {
        $this->authorize('view', $user);

        return response()->json([
            'user' => new UserResource($user),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $this->authorize('update', $user);

        $data = $request->validated();

        $user->update($data);

        return response()->json([
            'user' => new UserResource($user),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        $this->authorize('delete', $user);

        $user->delete();

        return response()->json([], 204);
    }

    /**
     * Promote the specified user to admin.
     */
    public function promote(User $user): JsonResponse
    {
        $this->authorize('promote', $user);

        $user->is_admin = true;
        $user->save();

        return response()->json([
            'user' => new UserResource($user),
        ], 200);
    }

    public function lower(User $user): JsonResponse
    {
        $this->authorize('lower', $user);

        $user->is_admin = false;
        $user->save();

        return response()->json([
            'user' => new UserResource($user),
        ], 200);
    }
}
