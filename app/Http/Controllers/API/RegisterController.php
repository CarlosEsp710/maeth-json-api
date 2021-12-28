<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Responses\TokenResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'type' => 'required',
            'image_profile' => 'required|url',
            'birthday' => 'required|date',
            'gender' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type,
            'image_profile' => $request->image_profile,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
        ]);

        if ($user->type === User::PATIENT) {
            $user->verified = User::ACCEPTED;
            $user->verified_at = now();

            $user->save();

            $user->assignRole('patient', 'sanctum');
        }

        if ($user->type === User::NUTRITIONIST) {
            $user->assignRole('nutritionist', 'sanctum');
        }

        return new TokenResponse($user);
    }
}
