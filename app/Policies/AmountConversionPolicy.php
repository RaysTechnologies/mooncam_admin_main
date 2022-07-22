<?php

namespace App\Policies;

use App\Models\User;
use App\Models\AmountConversion;
use Illuminate\Auth\Access\HandlesAuthorization;

class AmountConversionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the amountConversion can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the amountConversion can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AmountConversion  $model
     * @return mixed
     */
    public function view(User $user, AmountConversion $model)
    {
        return true;
    }

    /**
     * Determine whether the amountConversion can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the amountConversion can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AmountConversion  $model
     * @return mixed
     */
    public function update(User $user, AmountConversion $model)
    {
        return true;
    }

    /**
     * Determine whether the amountConversion can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AmountConversion  $model
     * @return mixed
     */
    public function delete(User $user, AmountConversion $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AmountConversion  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the amountConversion can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AmountConversion  $model
     * @return mixed
     */
    public function restore(User $user, AmountConversion $model)
    {
        return false;
    }

    /**
     * Determine whether the amountConversion can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AmountConversion  $model
     * @return mixed
     */
    public function forceDelete(User $user, AmountConversion $model)
    {
        return false;
    }
}
