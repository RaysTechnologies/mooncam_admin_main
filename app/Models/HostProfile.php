<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HostProfile extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'age',
        'mobile',
        'email',
        'gender',
        'photo',
        'fans_count',
        'followup_count',
        'visitor_count',
        'firebase_id',
        'token_rate_videocall',
        'token_rate_groupcall',
        'user_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'host_profiles';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bankDetails()
    {
        return $this->hasOne(BankDetails::class);
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function callPrice()
    {
        return $this->hasOne(CallPrice::class);
    }

    public function giftTransactions()
    {
        return $this->hasMany(GiftTransaction::class);
    }

    public function freeTokenTransactions()
    {
        return $this->hasMany(FreeTokenTransaction::class);
    }

    public function withdrawlTransactions()
    {
        return $this->hasMany(WithdrawlTransaction::class);
    }

    public function reportAndBlocks()
    {
        return $this->hasMany(ReportAndBlock::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function videoCallTransactions()
    {
        return $this->hasMany(VideoCallTransaction::class);
    }
}
