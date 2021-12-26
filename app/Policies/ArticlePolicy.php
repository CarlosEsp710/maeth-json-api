<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->can('articles:admin')) {
            return true;
        }
    }

    public function index(User $user, $request)
    {
        return $user->can('articles:index');
    }

    public function create(User $user, $request)
    {
        return $user->can('articles:create') &&
            $user->id === $request->json('.data.relationships.author.data.id');
    }

    public function read(User $user, $request)
    {
        return $user->can('articles:read');
    }

    public function update(User $user, $article)
    {
        return $user->can('articles:update') &&
            $article->user->is($user);
    }

    public function delete(User $user, $article)
    {
        return $user->can('articles:delete') &&
            $article->user->is($user);
    }

    public function modifyCategory(User $user, $article)
    {
        return $user->can('articles:modify-category') &&
            $article->user->is($user);
    }

    public function modifyAuthor(User $user, $article)
    {
        return $user->can('articles:modify-author') &&
            $article->user->is($user);
    }
}
