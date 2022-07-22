<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VideoCallTransaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoCallTransactionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the videoCallTransaction can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the videoCallTransaction can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\VideoCallTransaction  $model
     * @return mixed
     */
    public function view(User $user, VideoCallTransaction $model)
    {
        return true;
    }

    /**
     * Determine whether the videoCallTransaction can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the videoCallTransaction can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\VideoCallTransaction  $model
     * @return mixed
     */
    public function update(User $user, VideoCallTransaction $model)
    {
        return true;
    }

    /**
     * Determine whether the videoCallTransaction can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\VideoCallTransaction  $model
     * @return mixed
     */
    public function delete(User $user, VideoCallTransaction $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\VideoCallTransaction  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the videoCallTransaction can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\VideoCallTransaction  $model
     * @return mixed
     */
    public function restore(User $user, VideoCallTransaction $model)
    {
        return false;
    }

    /**
     * Determine whether the videoCallTransaction can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\VideoCallTransaction  $model
     * @return mixed
     */
    public function forceDelete(User $user, VideoCallTransaction $model)
    {
        return false;
    }
}
