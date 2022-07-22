<?php

namespace App\Policies;

use App\Models\User;
use App\Models\GiftTransaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class GiftTransactionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the giftTransaction can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the giftTransaction can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\GiftTransaction  $model
     * @return mixed
     */
    public function view(User $user, GiftTransaction $model)
    {
        return true;
    }

    /**
     * Determine whether the giftTransaction can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the giftTransaction can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\GiftTransaction  $model
     * @return mixed
     */
    public function update(User $user, GiftTransaction $model)
    {
        return true;
    }

    /**
     * Determine whether the giftTransaction can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\GiftTransaction  $model
     * @return mixed
     */
    public function delete(User $user, GiftTransaction $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\GiftTransaction  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the giftTransaction can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\GiftTransaction  $model
     * @return mixed
     */
    public function restore(User $user, GiftTransaction $model)
    {
        return false;
    }

    /**
     * Determine whether the giftTransaction can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\GiftTransaction  $model
     * @return mixed
     */
    public function forceDelete(User $user, GiftTransaction $model)
    {
        return false;
    }
}
