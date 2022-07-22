<?php

namespace App\Policies;

use App\Models\User;
use App\Models\FreeTokenTransaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class FreeTokenTransactionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the freeTokenTransaction can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the freeTokenTransaction can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\FreeTokenTransaction  $model
     * @return mixed
     */
    public function view(User $user, FreeTokenTransaction $model)
    {
        return true;
    }

    /**
     * Determine whether the freeTokenTransaction can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the freeTokenTransaction can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\FreeTokenTransaction  $model
     * @return mixed
     */
    public function update(User $user, FreeTokenTransaction $model)
    {
        return true;
    }

    /**
     * Determine whether the freeTokenTransaction can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\FreeTokenTransaction  $model
     * @return mixed
     */
    public function delete(User $user, FreeTokenTransaction $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\FreeTokenTransaction  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the freeTokenTransaction can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\FreeTokenTransaction  $model
     * @return mixed
     */
    public function restore(User $user, FreeTokenTransaction $model)
    {
        return false;
    }

    /**
     * Determine whether the freeTokenTransaction can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\FreeTokenTransaction  $model
     * @return mixed
     */
    public function forceDelete(User $user, FreeTokenTransaction $model)
    {
        return false;
    }
}
