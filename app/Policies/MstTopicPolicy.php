<?php

namespace App\Policies;

use App\Models\MstTopic;
use App\Models\User;

class MstTopicPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'pustakawan']);
    }

    public function view(User $user, MstTopic $mstTopic): bool
    {
        return in_array($user->role, ['admin', 'pustakawan']);
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, MstTopic $mstTopic): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, MstTopic $mstTopic): bool
    {
        return $user->role === 'admin';
    }

    public function restore(User $user, MstTopic $mstTopic): bool
    {
        return $user->role === 'admin';
    }

    public function forceDelete(User $user, MstTopic $mstTopic): bool
    {
        return $user->role === 'admin';
    }
}
