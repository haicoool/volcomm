<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    use HasFactory;

    protected $table = 'opportunities';
    protected $primaryKey = 'oppId';

    protected $fillable = [
        'organizationId',
        'oppTitle',
        'oppDesc',
        'oppImage',
        'oppLocation',
        'oppDate',
        'oppTime',
        'reqSkill',
        'maxCapacity',
        'currentReg', // Assuming this tracks current registrations
        'reqQualification',
        'category',
    ];

    // Define the relationship between Opportunity and Volunteer
    public function volunteers()
    {
        return $this->belongsToMany(Volunteer::class, 'registrations', 'oppId', 'vId')
            ->withTimestamps(); // Pivot table: registrations
    }

    // Define relationship between Opportunity and Registration
    public function registrations()
    {
        return $this->hasMany(Registration::class, 'oppId');
    }

    // Opportunity.php
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organizationId', 'organizationId'); // Specify both keys
    }

    protected $casts = [
        'oppDate' => 'date',
    ];



}
