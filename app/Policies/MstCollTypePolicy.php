<?php

namespace App\Policies;

use App\Models\MstCollType;
use App\Models\User;

class MstCollTypePolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'pustakawan']);
    }

    public function view(User $user, MstCollType $mstCollType): bool
    {
        return in_array($user->role, ['admin', 'pustakawan']);
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, MstCollType $mstCollType): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, MstCollType $mstCollType): bool
    {
        return $user->role === 'admin';
    }

    public function restore(User $user, MstCollType $mstCollType): bool
    {
        return $user->role === 'admin';
    }

    public function forceDelete(User $user, MstCollType $mstCollType): bool
    {
        return $user->role === 'admin';
    }
}
