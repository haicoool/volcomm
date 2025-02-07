<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'regId',
        'oppId',
    ];

    // Optionally, define relationships if needed
    public function registration()
    {
        return $this->belongsTo(Registration::class, 'regId');
    }

    public function opportunity()
    {
        return $this->belongsTo(Opportunity::class, 'oppId');
    }
}
