<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Volunteer;
use App\Models\Opportunity;
use App\Models\Certificate;

class Registration extends Model
{
    use HasFactory;

    protected $table = 'registrations';
    protected $primaryKey = 'regId';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'regId',
        'vId',
        'vName',
        'vSkill',
        'vQualification',
        'oppId',
        'status',
    ];

    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class, 'vId', 'vId');
    }

    public function opportunity()
    {
        return $this->belongsTo(Opportunity::class, 'oppId');
    }

    public function certificate()
    {
        return $this->hasOne(Certificate::class, 'registrationId', 'regId');
    }

}
