<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance_record extends Model
{
    use HasFactory;

    protected $primaryKey = 'record_id';
    protected $fillable = ['unit_id', 'user_id', 'status'];
}
