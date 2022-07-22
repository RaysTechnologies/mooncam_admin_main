<?php

namespace App\Policies;

use App\Models\User;
use App\Models\RechargeAmount;
use Illuminate\Auth\Access\HandlesAuthorization;

class RechargeAmountPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the rechargeAmount can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the rechargeAmount can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\RechargeAmount  $model
     * @return mixed
     */
    public function view(User $user, RechargeAmount $model)
    {
        return true;
    }

    /**
     * Determine whether the rechargeAmount can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the rechargeAmount can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\RechargeAmount  $model
     * @return mixed
     */
    public function update(User $user, RechargeAmount $model)
    {
        return true;
    }

    /**
     * Determine whether the rechargeAmount can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\RechargeAmount  $model
     * @return mixed
     */
    public function delete(User $user, RechargeAmount $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\RechargeAmount  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the rechargeAmount can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\RechargeAmount  $model
     * @return mixed
     */
    public function restore(User $user, RechargeAmount $model)
    {
        return false;
    }

    /**
     * Determine whether the rechargeAmount can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\RechargeAmount  $model
     * @return mixed
     */
    public function forceDelete(User $user, RechargeAmount $model)
    {
        return false;
    }
}
