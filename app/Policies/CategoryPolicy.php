<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->can('categories:admin')) {
            return true;
        }
    }

    public function index(User $user, $request)
    {
        return $user->can('categories:index');
    }

    public function create(User $user, $request)
    {
        return $user->can('categories:create');
    }

    public function read(User $user, $request)
    {
        return $user->can('categories:read');
    }

    public function update(User $user, $article)
    {
        return $user->can('categories:update');
    }

    public function delete(User $user, $article)
    {
        return $user->can('categories:delete');
    }
}
