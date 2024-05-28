<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutPass extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'asset_id',
        'init_date',
        'end_date',
        'auth',
        'in_office',
    ];
}
