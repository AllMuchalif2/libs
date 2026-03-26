<?php

namespace App\Policies;

use App\Models\MstPublisher;
use App\Models\User;

class MstPublisherPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'pustakawan']);
    }

    public function view(User $user, MstPublisher $mstPublisher): bool
    {
        return in_array($user->role, ['admin', 'pustakawan']);
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, MstPublisher $mstPublisher): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, MstPublisher $mstPublisher): bool
    {
        return $user->role === 'admin';
    }

    public function restore(User $user, MstPublisher $mstPublisher): bool
    {
        return $user->role === 'admin';
    }

    public function forceDelete(User $user, MstPublisher $mstPublisher): bool
    {
        return $user->role === 'admin';
    }
}
