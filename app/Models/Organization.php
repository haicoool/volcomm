<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Organization extends Authenticatable
{
    // Specify the table associated with this model
    protected $table = 'organizations';

    // Specify the primary key for the table
    protected $primaryKey = 'organizationId';

    // Fillable fields for mass assignment
    protected $fillable = [
        'organizationName',
        'organizationEmail',
        'organizationPass',
        'organizationAbout',
        'logo',
        'isApproved',
    ];

    // Hide the password field from arrays or JSON responses
    protected $hidden = ['organizationPass'];

    // This tells Laravel to use `organizationPass` as the password field for authentication
    public function getAuthPassword()
    {
        return $this->organizationPass;
    }

    public function opportunities(): HasMany
    {
        return $this->hasMany(Opportunity::class, 'organizationId', 'organizationId'); // Foreign key and local key specified
    }

    // Optionally, cast specific fields if needed
    protected $casts = [
        'organizationAbout' => 'array',  // Example of casting, modify based on actual usage
    ];

    public function pastOpportunities()
    {
        return $this->opportunities()->where('oppDate', '<=', now());
    }
}
