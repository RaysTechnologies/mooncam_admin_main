<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Gallery;
use Illuminate\Auth\Access\HandlesAuthorization;

class GalleryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the gallery can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the gallery can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Gallery  $model
     * @return mixed
     */
    public function view(User $user, Gallery $model)
    {
        return true;
    }

    /**
     * Determine whether the gallery can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the gallery can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Gallery  $model
     * @return mixed
     */
    public function update(User $user, Gallery $model)
    {
        return true;
    }

    /**
     * Determine whether the gallery can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Gallery  $model
     * @return mixed
     */
    public function delete(User $user, Gallery $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Gallery  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the gallery can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Gallery  $model
     * @return mixed
     */
    public function restore(User $user, Gallery $model)
    {
        return false;
    }

    /**
     * Determine whether the gallery can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Gallery  $model
     * @return mixed
     */
    public function forceDelete(User $user, Gallery $model)
    {
        return false;
    }
}
