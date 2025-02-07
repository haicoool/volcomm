<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admins';

    // Specify the primary key if it's not 'id'
    protected $primaryKey = 'adminId';

    // Since adminId is auto-incrementing, these are the default settings
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'adminName',
        'adminEmail',
        'adminPass',
    ];

    protected $hidden = [
        'adminPass',
    ];

    public function getAuthPassword()
    {
        return $this->adminPass;
    }
}
