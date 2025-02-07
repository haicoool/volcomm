<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class Volunteer extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'volunteers';
    protected $primaryKey = 'vId'; // Ensure this matches your database setup

    protected $fillable = [
        'vName',
        'vEmail',
        'vPass',
        'vSkill',
        'vProfilepic',
        'vQualification',
        'interest' // Add interest
    ];

    // Hide the password from arrays or JSON responses
    protected $hidden = ['vPass'];

    // This tells Laravel to use `vPass` as the password field for authentication
    public function getAuthPassword()
    {
        return $this->vPass;
    }

    // Cast qualifications and interests to an array
    protected $casts = [
        'vQualification' => 'array',
        'vInterest' => 'array' // Cast interest to an array
    ];

    // Define the relationship between Volunteer and Opportunity
    public function opportunities()
    {
        return $this->belongsToMany(Opportunity::class, 'registrations', 'vId', 'oppId')
            ->withTimestamps(); // Pivot table: registrations
    }

    // Define relationship between Volunteer and Registration
    public function registrations()
    {
        return $this->hasMany(Registration::class, 'vId');
    }
}
