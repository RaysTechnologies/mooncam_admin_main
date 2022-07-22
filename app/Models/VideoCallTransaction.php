<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VideoCallTransaction extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'reciever_id',
        'sender_id',
        'call_duration',
        'token_charge',
        'host_profile_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'video_call_transactions';

    public function hostProfile()
    {
        return $this->belongsTo(HostProfile::class);
    }
}
