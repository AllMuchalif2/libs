<?php

namespace App\Policies;

use App\Models\MstLocation;
use App\Models\User;

class MstLocationPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'pustakawan']);
    }

    public function view(User $user, MstLocation $mstLocation): bool
    {
        return in_array($user->role, ['admin', 'pustakawan']);
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, MstLocation $mstLocation): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, MstLocation $mstLocation): bool
    {
        return $user->role === 'admin';
    }

    public function restore(User $user, MstLocation $mstLocation): bool
    {
        return $user->role === 'admin';
    }

    public function forceDelete(User $user, MstLocation $mstLocation): bool
    {
        return $user->role === 'admin';
    }
}
