<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GiftList extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'image', 'token', 'user_id'];

    protected $searchableFields = ['*'];

    protected $table = 'gift_lists';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
