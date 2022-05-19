<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Acciones;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccionesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the acciones can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list allacciones');
    }

    /**
     * Determine whether the acciones can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Acciones  $model
     * @return mixed
     */
    public function view(User $user, Acciones $model)
    {
        return $user->hasPermissionTo('view allacciones');
    }

    /**
     * Determine whether the acciones can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create allacciones');
    }

    /**
     * Determine whether the acciones can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Acciones  $model
     * @return mixed
     */
    public function update(User $user, Acciones $model)
    {
        return $user->hasPermissionTo('update allacciones');
    }

    /**
     * Determine whether the acciones can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Acciones  $model
     * @return mixed
     */
    public function delete(User $user, Acciones $model)
    {
        return $user->hasPermissionTo('delete allacciones');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Acciones  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete allacciones');
    }

    /**
     * Determine whether the acciones can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Acciones  $model
     * @return mixed
     */
    public function restore(User $user, Acciones $model)
    {
        return false;
    }

    /**
     * Determine whether the acciones can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Acciones  $model
     * @return mixed
     */
    public function forceDelete(User $user, Acciones $model)
    {
        return false;
    }
}
