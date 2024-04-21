<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    use HasFactory;
    protected $primaryKey = 'campus_id';

    protected $fillable = [
        'campus_name',
        'latitude',
        'longitude',
        'status'
    ];
}
