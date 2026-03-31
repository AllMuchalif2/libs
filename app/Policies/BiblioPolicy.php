<?php

namespace App\Policies;

use App\Models\Biblio;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BiblioPolicy
{
    /**
     * Bypass authorization for Admin role.
     */
    public function before(User $user, string $ability)
    {
        if ($user->role === 'admin') {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'pustakawan']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Biblio $biblio): bool
    {
        return in_array($user->role, ['admin', 'pustakawan']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Biblio $biblio): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Biblio $biblio): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Biblio $biblio): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Biblio $biblio): bool
    {
        return $user->role === 'admin';
    }
}
