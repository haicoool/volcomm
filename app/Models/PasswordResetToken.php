<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    protected $table = 'password_reset_tokens';
    protected $primaryKey = 'email';
    public $incrementing = false; // Because email is not an integer primary key
    protected $fillable = ['email', 'token', 'created_at'];
    public $timestamps = false; // Since we manually manage created_at
}
