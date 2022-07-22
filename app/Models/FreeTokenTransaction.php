<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FreeTokenTransaction extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['free_token', 'host_profile_id'];

    protected $searchableFields = ['*'];

    protected $table = 'free_token_transactions';

    public function hostProfile()
    {
        return $this->belongsTo(HostProfile::class);
    }
}
