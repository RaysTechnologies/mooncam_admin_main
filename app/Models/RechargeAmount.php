<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RechargeAmount extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['amount', 'token', 'unit', 'user_id'];

    protected $searchableFields = ['*'];

    protected $table = 'recharge_amounts';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
