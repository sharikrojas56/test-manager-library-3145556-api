<?php

namespace App\Infrastructure\Outbound\Persistence\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    public $incrementing = false;
    
    protected $fillable = [
        'id',
        'username',
        'password_hash',
        'role',
    ];
    
    protected $hidden = [
        'password_hash',
    ];
    
    protected $casts = [
        'id' => 'string',
    ];
}