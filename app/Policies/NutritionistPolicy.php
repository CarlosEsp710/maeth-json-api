<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NutritionistPolicy
{
    use HandlesAuthorization;

    public function create(User $user, $request)
    {
        //$user->can('nutritionist:create')
        return $user->can('nutritionists:create')
            &&  $user->type === User::NUTRITIONIST
            && $user->id === $request->json('data.relationships.user.data.id');
    }

    public function update(User $user, $nutritionist)
    {
        return  $user->can('nutritionists:update')
            && $user->type === User::NUTRITIONIST
            &&  $nutritionist->user->is($user);
    }
}
