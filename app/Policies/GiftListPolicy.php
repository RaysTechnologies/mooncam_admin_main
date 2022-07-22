<?php

namespace App\Policies;

use App\Models\User;
use App\Models\GiftList;
use Illuminate\Auth\Access\HandlesAuthorization;

class GiftListPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the giftList can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the giftList can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\GiftList  $model
     * @return mixed
     */
    public function view(User $user, GiftList $model)
    {
        return true;
    }

    /**
     * Determine whether the giftList can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the giftList can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\GiftList  $model
     * @return mixed
     */
    public function update(User $user, GiftList $model)
    {
        return true;
    }

    /**
     * Determine whether the giftList can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\GiftList  $model
     * @return mixed
     */
    public function delete(User $user, GiftList $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\GiftList  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the giftList can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\GiftList  $model
     * @return mixed
     */
    public function restore(User $user, GiftList $model)
    {
        return false;
    }

    /**
     * Determine whether the giftList can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\GiftList  $model
     * @return mixed
     */
    public function forceDelete(User $user, GiftList $model)
    {
        return false;
    }
}
