<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BankDetails extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['country', 'host_profile_id'];

    protected $searchableFields = ['*'];

    protected $table = 'bank_details';

    public function hostProfile()
    {
        return $this->belongsTo(HostProfile::class);
    }
}
