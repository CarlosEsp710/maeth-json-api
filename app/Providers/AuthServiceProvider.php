<?php

namespace App\Providers;

use App\Models\Article;
use App\Policies\ArticlePolicy;
use App\Models\Category;
use App\Models\Nutritionist;
use App\Models\Patient;
use App\Models\User;
use App\Policies\CategoryPolicy;
use App\Policies\NutritionistPolicy;
use App\Policies\PatientPolicy;
use App\Policies\UserPolicy;
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
        User::class => UserPolicy::class,
        Nutritionist::class => NutritionistPolicy::class,
        Patient::class => PatientPolicy::class,
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
