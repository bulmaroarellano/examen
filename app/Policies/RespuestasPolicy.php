<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Respuestas;
use Illuminate\Auth\Access\HandlesAuthorization;

class RespuestasPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the respuestas can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list allrespuestas');
    }

    /**
     * Determine whether the respuestas can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Respuestas  $model
     * @return mixed
     */
    public function view(User $user, Respuestas $model)
    {
        return $user->hasPermissionTo('view allrespuestas');
    }

    /**
     * Determine whether the respuestas can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create allrespuestas');
    }

    /**
     * Determine whether the respuestas can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Respuestas  $model
     * @return mixed
     */
    public function update(User $user, Respuestas $model)
    {
        return $user->hasPermissionTo('update allrespuestas');
    }

    /**
     * Determine whether the respuestas can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Respuestas  $model
     * @return mixed
     */
    public function delete(User $user, Respuestas $model)
    {
        return $user->hasPermissionTo('delete allrespuestas');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Respuestas  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete allrespuestas');
    }

    /**
     * Determine whether the respuestas can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Respuestas  $model
     * @return mixed
     */
    public function restore(User $user, Respuestas $model)
    {
        return false;
    }

    /**
     * Determine whether the respuestas can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Respuestas  $model
     * @return mixed
     */
    public function forceDelete(User $user, Respuestas $model)
    {
        return false;
    }
}
