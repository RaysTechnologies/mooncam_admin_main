<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CallPrice extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'video_call',
        'live_streaming',
        'video_call_price_limit',
        'live_streaming_call_price_limit',
        'photo_price',
        'host_profile_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'call_prices';

    public function hostProfile()
    {
        return $this->belongsTo(HostProfile::class);
    }
}
