<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Models\Scopes\Searchable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    use Searchable;
    use HasApiTokens;

    protected $fillable = ['name', 'email', 'password'];

    protected $searchableFields = ['*'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hostProfiles()
    {
        return $this->hasMany(HostProfile::class);
    }

    public function countryList()
    {
        return $this->hasOne(CountryList::class);
    }

    public function giftList()
    {
        return $this->hasOne(GiftList::class);
    }

    public function rechargeAmount()
    {
        return $this->hasOne(RechargeAmount::class);
    }

    public function amountConversion()
    {
        return $this->hasOne(AmountConversion::class);
    }

    public function isSuperAdmin()
    {
        return in_array($this->email, config('auth.super_admins'));
    }
}
