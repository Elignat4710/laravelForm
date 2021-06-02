<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function country()
    {
        return $this->belongsTo(Country::class, 'countryId');
    }

    protected $fillable = [
        'firstName',
        'lastName',
        'birthdate',
        'reportSubject',
        'phone',
        'email',
        'countryId',
    ];
}
