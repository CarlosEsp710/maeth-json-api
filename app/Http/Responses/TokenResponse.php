<?php

namespace App\Http\Responses;

use App\Models\User;
use Illuminate\Contracts\Support\Responsable;

class TokenResponse implements Responsable
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function toResponse($request)
    {
        $this->user->currentAccessToken()->delete();

        return response()->json([
            'user_id' => $this->user->id,
            'plain-text-token' => $this->user->createToken($request->device_name)->plainTextToken
        ]);
    }
}
