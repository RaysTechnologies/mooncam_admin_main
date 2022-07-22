<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReportAndBlock extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'blocked_user_id',
        'blocked_user_name',
        'host_profile_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'report_and_blocks';

    public function hostProfile()
    {
        return $this->belongsTo(HostProfile::class);
    }
}
