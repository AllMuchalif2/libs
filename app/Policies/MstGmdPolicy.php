<?php

namespace App\Policies;

use App\Models\MstGmd;
use App\Models\User;

class MstGmdPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'pustakawan']);
    }

    public function view(User $user, MstGmd $mstGmd): bool
    {
        return in_array($user->role, ['admin', 'pustakawan']);
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, MstGmd $mstGmd): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, MstGmd $mstGmd): bool
    {
        return $user->role === 'admin';
    }

    public function restore(User $user, MstGmd $mstGmd): bool
    {
        return $user->role === 'admin';
    }

    public function forceDelete(User $user, MstGmd $mstGmd): bool
    {
        return $user->role === 'admin';
    }
}
