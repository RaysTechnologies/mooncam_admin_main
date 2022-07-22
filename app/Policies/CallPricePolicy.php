<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CallPrice;
use Illuminate\Auth\Access\HandlesAuthorization;

class CallPricePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the callPrice can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the callPrice can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CallPrice  $model
     * @return mixed
     */
    public function view(User $user, CallPrice $model)
    {
        return true;
    }

    /**
     * Determine whether the callPrice can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the callPrice can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CallPrice  $model
     * @return mixed
     */
    public function update(User $user, CallPrice $model)
    {
        return true;
    }

    /**
     * Determine whether the callPrice can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CallPrice  $model
     * @return mixed
     */
    public function delete(User $user, CallPrice $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CallPrice  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the callPrice can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CallPrice  $model
     * @return mixed
     */
    public function restore(User $user, CallPrice $model)
    {
        return false;
    }

    /**
     * Determine whether the callPrice can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CallPrice  $model
     * @return mixed
     */
    public function forceDelete(User $user, CallPrice $model)
    {
        return false;
    }
}
