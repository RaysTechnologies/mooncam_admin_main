<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CountryList;
use Illuminate\Auth\Access\HandlesAuthorization;

class CountryListPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the countryList can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the countryList can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CountryList  $model
     * @return mixed
     */
    public function view(User $user, CountryList $model)
    {
        return true;
    }

    /**
     * Determine whether the countryList can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the countryList can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CountryList  $model
     * @return mixed
     */
    public function update(User $user, CountryList $model)
    {
        return true;
    }

    /**
     * Determine whether the countryList can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CountryList  $model
     * @return mixed
     */
    public function delete(User $user, CountryList $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CountryList  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the countryList can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CountryList  $model
     * @return mixed
     */
    public function restore(User $user, CountryList $model)
    {
        return false;
    }

    /**
     * Determine whether the countryList can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CountryList  $model
     * @return mixed
     */
    public function forceDelete(User $user, CountryList $model)
    {
        return false;
    }
}
