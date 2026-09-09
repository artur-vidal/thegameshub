<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

#[Guarded('id', 'created_at', 'updated_at')]
class User extends Authenticatable
{
    use HasFactory;
    
    protected $casts = [
        'password' => 'hashed'
    ];
}
