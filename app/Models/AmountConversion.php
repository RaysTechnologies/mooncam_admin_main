<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AmountConversion extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['token', 'amount', 'unit', 'symbol', 'user_id'];

    protected $searchableFields = ['*'];

    protected $table = 'amount_conversions';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
