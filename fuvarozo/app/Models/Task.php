<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'starting_address', 
        'ending_address', 
        'person_name',
        'phone_number', 
        'status', 
        'driver_id',
    ];

}
