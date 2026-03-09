<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
   protected $fillable = [
        'code', 'discount', 'type', 'valid_until', 'uses', 'max_uses'
    ];
}
