<?php

namespace App\Policies;

use App\Models\Nature;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NaturePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role->permissions->contains('name', 'nature.viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Nature $nature): bool
    {
        return $user->role->permissions->contains('name', 'nature.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role->permissions->contains('name', 'nature.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Nature $nature): bool
    {
        return $user->role->permissions->contains('name', 'nature.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Nature $nature): bool
    {
        return $user->role->permissions->contains('name', 'nature.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Nature $nature): bool
    {
        return $user->role->permissions->contains('name', 'nature.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Nature $nature): bool
    {
        return $user->role->permissions->contains('name', 'nature.forceDelete');
    }
}
