<?php

namespace App\Providers;

use App\Models\Article;
use App\Policies\ArticlePolicy;
use App\Models\Category;
use App\Models\Nutritionist;
use App\Policies\CategoryPolicy;
use App\Policies\NutritionistPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Article::class => ArticlePolicy::class,
        Category::class => CategoryPolicy::class,
        Nutritionist::class => NutritionistPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
