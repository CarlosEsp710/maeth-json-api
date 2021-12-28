<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PatientPolicy
{
    use HandlesAuthorization;

    public function create(User $user, $request)
    {
        //$user->can('nutritionist:create')
        return  $user->type === User::PATIENT
            && $user->id === $request->json('data.relationships.user.data.id');
    }

    public function update(User $user, $nutritionist)
    {
        //$user->can('articles:update') &&
        return  $nutritionist->user->is($user);
    }
}
