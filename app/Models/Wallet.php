<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wallet extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['token', 'free_token', 'host_profile_id'];

    protected $searchableFields = ['*'];

    public function hostProfile()
    {
        return $this->belongsTo(HostProfile::class);
    }
}
