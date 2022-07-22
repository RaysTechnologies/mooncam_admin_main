<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WithdrawlTransaction extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'token',
        'total_amount',
        'recieved_amount',
        'commision',
        'status',
        'date',
        'host_profile_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'withdrawl_transactions';

    protected $casts = [
        'date' => 'date',
    ];

    public function hostProfile()
    {
        return $this->belongsTo(HostProfile::class);
    }
}
