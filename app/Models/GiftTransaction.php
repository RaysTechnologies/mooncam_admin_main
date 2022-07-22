<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GiftTransaction extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'reciever_id',
        'sender_id',
        'gift_id',
        'gift_name',
        'token',
        'host_profile_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'gift_transactions';

    public function hostProfile()
    {
        return $this->belongsTo(HostProfile::class);
    }
}
