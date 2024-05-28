<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignableAsset extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'brand',
        'model',
        'description',
        'serial_number',
        'barcode',
        'purchase_date',
        'purchase_price',
        'condition',
        'out_pass',
        'supplier_id',
        'rack_id',
        'shelf_id',
        'box_id',
        'type_id',
    ];
}
