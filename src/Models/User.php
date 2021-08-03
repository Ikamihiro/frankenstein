<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;
    
    protected $table = 'users';

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'document',
        'birth_date',
    ];

    protected $casts = [
        'birth_date' => 'datetime'
    ];

    protected $dates = ['deleted_at'];
}