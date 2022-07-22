<?php

namespace App\Policies;

use App\Models\User;
use App\Models\HostProfile;
use Illuminate\Auth\Access\HandlesAuthorization;

class HostProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the hostProfile can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the hostProfile can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\HostProfile  $model
     * @return mixed
     */
    public function view(User $user, HostProfile $model)
    {
        return true;
    }

    /**
     * Determine whether the hostProfile can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the hostProfile can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\HostProfile  $model
     * @return mixed
     */
    public function update(User $user, HostProfile $model)
    {
        return true;
    }

    /**
     * Determine whether the hostProfile can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\HostProfile  $model
     * @return mixed
     */
    public function delete(User $user, HostProfile $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\HostProfile  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the hostProfile can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\HostProfile  $model
     * @return mixed
     */
    public function restore(User $user, HostProfile $model)
    {
        return false;
    }

    /**
     * Determine whether the hostProfile can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\HostProfile  $model
     * @return mixed
     */
    public function forceDelete(User $user, HostProfile $model)
    {
        return false;
    }
}
