<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Preguntas;
use Illuminate\Auth\Access\HandlesAuthorization;

class PreguntasPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the preguntas can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list allpreguntas');
    }

    /**
     * Determine whether the preguntas can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Preguntas  $model
     * @return mixed
     */
    public function view(User $user, Preguntas $model)
    {
        return $user->hasPermissionTo('view allpreguntas');
    }

    /**
     * Determine whether the preguntas can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create allpreguntas');
    }

    /**
     * Determine whether the preguntas can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Preguntas  $model
     * @return mixed
     */
    public function update(User $user, Preguntas $model)
    {
        return $user->hasPermissionTo('update allpreguntas');
    }

    /**
     * Determine whether the preguntas can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Preguntas  $model
     * @return mixed
     */
    public function delete(User $user, Preguntas $model)
    {
        return $user->hasPermissionTo('delete allpreguntas');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Preguntas  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete allpreguntas');
    }

    /**
     * Determine whether the preguntas can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Preguntas  $model
     * @return mixed
     */
    public function restore(User $user, Preguntas $model)
    {
        return false;
    }

    /**
     * Determine whether the preguntas can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Preguntas  $model
     * @return mixed
     */
    public function forceDelete(User $user, Preguntas $model)
    {
        return false;
    }
}
