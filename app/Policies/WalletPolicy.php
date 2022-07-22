<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Auth\Access\HandlesAuthorization;

class WalletPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the wallet can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the wallet can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Wallet  $model
     * @return mixed
     */
    public function view(User $user, Wallet $model)
    {
        return true;
    }

    /**
     * Determine whether the wallet can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the wallet can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Wallet  $model
     * @return mixed
     */
    public function update(User $user, Wallet $model)
    {
        return true;
    }

    /**
     * Determine whether the wallet can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Wallet  $model
     * @return mixed
     */
    public function delete(User $user, Wallet $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Wallet  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the wallet can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Wallet  $model
     * @return mixed
     */
    public function restore(User $user, Wallet $model)
    {
        return false;
    }

    /**
     * Determine whether the wallet can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Wallet  $model
     * @return mixed
     */
    public function forceDelete(User $user, Wallet $model)
    {
        return false;
    }
}
