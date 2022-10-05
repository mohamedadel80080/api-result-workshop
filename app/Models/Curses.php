<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curses extends Model
{

    protected $table = 'curses';

    protected $fillable = ['course_name' , 'description'] ;
    public function student(){
    return $this->belongsToMany('App\Models\Student');
    
        }
    use HasFactory;
}
