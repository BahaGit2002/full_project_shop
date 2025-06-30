<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function me(): JsonResponse
    {
        return response()->json(auth()->user());
    }

    public function update(UpdateUserRequest $request): JsonResponse
    {
        $user = auth()->user();
        $validated = $request->validated();

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->first_name = $validated['first_name'] ?? $user->first_name;
        $user->last_name = $validated['last_name'] ?? $user->last_name;
        $user->email = $validated['email'] ?? $user->email;
        $user->save();

        return response()->json([
            'message' => 'User updated successfully.',
            'user' => $user,
        ], 200);
    }
}
