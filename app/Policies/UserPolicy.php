<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    function view(User $user, User $model) {
        return $user->can('display');
    }


    function update(User $user, User $model) {
        return $user->can('edit');
    }
}
