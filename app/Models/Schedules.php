<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    use HasFactory;

    // fill用
    protected $fillable = [
        'event_title',
        'event_body',
        'start_date',
        'end_date',
        ];
        
}
