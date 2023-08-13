<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scadules; 

class scadules extends Model
{
    use HasFactory;
    
     // Controllerのfill用
    protected $fillable = [
        'schedule_title',
        'schedule_body',
        'start_date',
        'end_date',
        
    ];
}
class ScaduleController extends Controller
{   
    // カレンダー表示
    public function show(){
        return view("calendars/calendar");
    }
}
