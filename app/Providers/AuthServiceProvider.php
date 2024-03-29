<?php

namespace App\Providers;
use App\Policies\CategoryPolicy;
use App\Models\Category;
use App\Policies\PostPolicy;
use App\Models\Post;
use App\Policies\TagPolicy;
use App\Models\Tag;
use App\Policies\CommentPolicy;
use App\Models\Comment;



// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        Comment::class => CommentPolicy::class,
        Category::class => CategoryPolicy::class,
        Tag::class => TagPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
