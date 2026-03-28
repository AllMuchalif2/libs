<?php

namespace App\Policies;

use App\Models\MemberType;
use App\Models\User;

class MemberTypePolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'pustakawan']);
    }

    public function view(User $user, MemberType $memberType): bool
    {
        return in_array($user->role, ['admin', 'pustakawan']);
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, MemberType $memberType): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, MemberType $memberType): bool
    {
        return $user->role === 'admin';
    }

    public function restore(User $user, MemberType $memberType): bool
    {
        return $user->role === 'admin';
    }

    public function forceDelete(User $user, MemberType $memberType): bool
    {
        return $user->role === 'admin';
    }
}
