<?php

namespace App\Policies;

use App\Models\MstSubject;
use App\Models\User;

class MstSubjectPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'pustakawan']);
    }

    public function view(User $user, MstSubject $mstSubject): bool
    {
        return in_array($user->role, ['admin', 'pustakawan']);
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, MstSubject $mstSubject): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, MstSubject $mstSubject): bool
    {
        return $user->role === 'admin';
    }

    public function restore(User $user, MstSubject $mstSubject): bool
    {
        return $user->role === 'admin';
    }

    public function forceDelete(User $user, MstSubject $mstSubject): bool
    {
        return $user->role === 'admin';
    }
}
