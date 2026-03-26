<?php

namespace App\Policies;

use App\Models\MstAuthor;
use App\Models\User;

class MstAuthorPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'pustakawan']);
    }

    public function view(User $user, MstAuthor $mstAuthor): bool
    {
        return in_array($user->role, ['admin', 'pustakawan']);
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, MstAuthor $mstAuthor): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, MstAuthor $mstAuthor): bool
    {
        return $user->role === 'admin';
    }

    public function restore(User $user, MstAuthor $mstAuthor): bool
    {
        return $user->role === 'admin';
    }

    public function forceDelete(User $user, MstAuthor $mstAuthor): bool
    {
        return $user->role === 'admin';
    }
}
