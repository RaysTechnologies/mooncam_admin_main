<?php

namespace App\Policies;

use App\Models\User;
use App\Models\BankDetails;
use Illuminate\Auth\Access\HandlesAuthorization;

class BankDetailsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the bankDetails can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the bankDetails can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BankDetails  $model
     * @return mixed
     */
    public function view(User $user, BankDetails $model)
    {
        return true;
    }

    /**
     * Determine whether the bankDetails can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the bankDetails can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BankDetails  $model
     * @return mixed
     */
    public function update(User $user, BankDetails $model)
    {
        return true;
    }

    /**
     * Determine whether the bankDetails can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BankDetails  $model
     * @return mixed
     */
    public function delete(User $user, BankDetails $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BankDetails  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the bankDetails can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BankDetails  $model
     * @return mixed
     */
    public function restore(User $user, BankDetails $model)
    {
        return false;
    }

    /**
     * Determine whether the bankDetails can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\BankDetails  $model
     * @return mixed
     */
    public function forceDelete(User $user, BankDetails $model)
    {
        return false;
    }
}
