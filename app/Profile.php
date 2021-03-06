<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $fillable = [
        'first_name', 'last_name', 'contact_no', 'address_1', 'address_2', 'city', 'country', 'zip_code', 'state_province'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
