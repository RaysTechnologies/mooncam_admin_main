<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ReportAndBlock;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReportAndBlockPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the reportAndBlock can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the reportAndBlock can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ReportAndBlock  $model
     * @return mixed
     */
    public function view(User $user, ReportAndBlock $model)
    {
        return true;
    }

    /**
     * Determine whether the reportAndBlock can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the reportAndBlock can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ReportAndBlock  $model
     * @return mixed
     */
    public function update(User $user, ReportAndBlock $model)
    {
        return true;
    }

    /**
     * Determine whether the reportAndBlock can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ReportAndBlock  $model
     * @return mixed
     */
    public function delete(User $user, ReportAndBlock $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ReportAndBlock  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the reportAndBlock can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ReportAndBlock  $model
     * @return mixed
     */
    public function restore(User $user, ReportAndBlock $model)
    {
        return false;
    }

    /**
     * Determine whether the reportAndBlock can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ReportAndBlock  $model
     * @return mixed
     */
    public function forceDelete(User $user, ReportAndBlock $model)
    {
        return false;
    }
}
