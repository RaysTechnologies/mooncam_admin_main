<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BankDetails extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
    	'name', 
    	'address' , 
    	'mobile' , 
    	'email' , 
    	'account_no' , 
    	'ifsc' , 
    	'upiid_1' , 
    	'upiid_2' ,
    	'host_profile_id'
    ];

    protected $searchableFields = ['*'];

    protected $table = 'bank_details';

    public function hostProfile()
    {
        return $this->belongsTo(HostProfile::class);
    }
}
