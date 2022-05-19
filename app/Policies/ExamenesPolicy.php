<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Examenes;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExamenesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the examenes can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list allexamenes');
    }

    /**
     * Determine whether the examenes can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Examenes  $model
     * @return mixed
     */
    public function view(User $user, Examenes $model)
    {
        return $user->hasPermissionTo('view allexamenes');
    }

    /**
     * Determine whether the examenes can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create allexamenes');
    }

    /**
     * Determine whether the examenes can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Examenes  $model
     * @return mixed
     */
    public function update(User $user, Examenes $model)
    {
        return $user->hasPermissionTo('update allexamenes');
    }

    /**
     * Determine whether the examenes can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Examenes  $model
     * @return mixed
     */
    public function delete(User $user, Examenes $model)
    {
        return $user->hasPermissionTo('delete allexamenes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Examenes  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete allexamenes');
    }

    /**
     * Determine whether the examenes can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Examenes  $model
     * @return mixed
     */
    public function restore(User $user, Examenes $model)
    {
        return false;
    }

    /**
     * Determine whether the examenes can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Examenes  $model
     * @return mixed
     */
    public function forceDelete(User $user, Examenes $model)
    {
        return false;
    }
}
