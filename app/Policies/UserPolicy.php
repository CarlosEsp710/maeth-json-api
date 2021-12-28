<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->can('users:admin')) {
            return true;
        }
    }

    public function index(User $user, $request)
    {
        return $user->can('users:index');
    }

    public function create(User $user, $request)
    {
        return $user->can('users:create');
    }

    public function read(User $user, $request)
    {
        return $user->can('users:read');
    }

    public function update(User $user, $resource)
    {
        return $user->id === $resource->id &&
            $user->can('users:update');
    }

    public function delete(User $user, $resource)
    {
        return $user->can('users:delete');
    }
}
