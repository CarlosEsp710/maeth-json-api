<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PatientPolicy
{
    use HandlesAuthorization;

    public function create(User $user, $request)
    {
        return $user->can('patients:create')
            &&  $user->type === User::PATIENT
            && $user->id === $request->json('data.relationships.user.data.id');
    }

    public function update(User $user, $patient)
    {
        return  $user->can('patients:update')
            && $user->type === User::PATIENT
            &&  $patient->user->is($user);
    }
}
