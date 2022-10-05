<?php

namespace App\Models;
use App\Models\Student;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = ['name', 'course'];
    
    public function curses(){
        return $this->belongsToMany('App\Models\Curses');
        
        }
    use HasFactory;
}
