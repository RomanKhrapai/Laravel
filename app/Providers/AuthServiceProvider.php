<?php

namespace App\Providers;

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
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Area' => 'App\Policies\AreaPolicy',
        'App\Models\Nature' => 'App\Policies\NaturePolicy',
        'App\Models\Type' => 'App\Policies\TypePolicy',
        'App\Models\Role' => 'App\Policies\RolePolicy',
        'App\Models\Skill' => 'App\Policies\SkillPolicy',
        'App\Models\Vacancy' => 'App\Policies\VacancyPolicy',
        'App\Models\Company' => 'App\Policies\CompanyPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
