<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WithdrawlTransaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class WithdrawlTransactionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the withdrawlTransaction can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the withdrawlTransaction can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\WithdrawlTransaction  $model
     * @return mixed
     */
    public function view(User $user, WithdrawlTransaction $model)
    {
        return true;
    }

    /**
     * Determine whether the withdrawlTransaction can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the withdrawlTransaction can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\WithdrawlTransaction  $model
     * @return mixed
     */
    public function update(User $user, WithdrawlTransaction $model)
    {
        return true;
    }

    /**
     * Determine whether the withdrawlTransaction can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\WithdrawlTransaction  $model
     * @return mixed
     */
    public function delete(User $user, WithdrawlTransaction $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\WithdrawlTransaction  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the withdrawlTransaction can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\WithdrawlTransaction  $model
     * @return mixed
     */
    public function restore(User $user, WithdrawlTransaction $model)
    {
        return false;
    }

    /**
     * Determine whether the withdrawlTransaction can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\WithdrawlTransaction  $model
     * @return mixed
     */
    public function forceDelete(User $user, WithdrawlTransaction $model)
    {
        return false;
    }
}
