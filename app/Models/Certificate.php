<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'registrationId',
        'oppTitle',
        'vName',
        'oppLocation',
        'oppDate',
        'logo',
        'signature',
        'signerName',
        'signerPosition',
    ];

    protected $primaryKey = 'certificateId';

    public function registration()
    {
        return $this->belongsTo(Registration::class, 'registrationId', 'regId');
    }
}
