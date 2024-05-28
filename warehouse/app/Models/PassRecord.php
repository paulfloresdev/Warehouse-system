<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassRecord extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'out_pass_id',
        'date',
    ];
}
