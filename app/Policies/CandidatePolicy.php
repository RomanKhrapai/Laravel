<?php

namespace App\Policies;

use App\Models\Candidate;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CandidatePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role->permissions->contains('name', 'candidate.viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Candidate $candidate): bool
    {
        return $user->role->permissions->contains('name', 'candidate.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role->permissions->contains('name', 'candidate.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Candidate $candidate): bool
    {
        return $user->role->permissions->contains('name', 'candidate.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Candidate $candidate): bool
    {
        return $user->role->permissions->contains('name', 'candidate.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Candidate $candidate): bool
    {
        return $user->role->permissions->contains('name', 'candidate.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Candidate $candidate): bool
    {
        return $user->role->permissions->contains('name', 'candidate.forceDelete');
    }
}
