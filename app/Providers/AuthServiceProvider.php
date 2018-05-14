<?php

namespace App\Providers;

use App\Models\AdminPermission;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\Models\Post::class=>\App\Policies\PostPolicy::class,
        \App\Models\User::class=>\App\Policies\UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $permissions=AdminPermission::all();
        foreach ($permissions as $permission){
            Gate::define($permission->name,function($user) use($permission){
                return $user->hasPermission($permission);
            });
        }

        //
    }
}
