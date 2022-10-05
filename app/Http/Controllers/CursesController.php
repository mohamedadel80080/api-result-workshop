<?php

namespace App\Http\Controllers;
use App\Models\Curses;

use Illuminate\Http\Request;

class CursesController extends Controller
{

public function getAllCurses()

{

    $curses = Curses::get()->toJson(JSON_PRETTY_PRINT);
    return response($curses , 200 ); 
}
public function createCurses(Request $request) {
    // logic to create a student record goes here
    $course = new Curses;
    $course->course_name = $request->course_name;
    $course->description = $request->description;
    $course->save();

    return response()->json([
        "message" => "Curses record created"
    ], 201);

  
  }

  public function getCurses($id) {
  
    
    if (Curses::where('id', $id)->exists())
     {

      $course = Curses::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
      return response($course, 200);
    } 
    
    else {

      return response()->json([
        "message" => "Curses not found"
      ], 404);
    }
    // logic to get a student record goes here
  }

  public function updateCurses(Request $request, $id) {

    if (Curses::where('id', $id)->exists()) {
      $course = Curses::find($id);
      $course->course_name = is_null($request->course_name) ? $course->course_name : $request->course_name;
      $course->description = is_null($request->description) ? $course->description : $request->description;
      $course->save();

      return response()->json([
          "message" => "records updated successfully"
      ], 200);
      } else {
      return response()->json([
          "message" => "course not found"
      ], 404);
      
  }
    // logic to update a student record goes here
  }

  public function deleteCurses ($id) {
    if(Curses::where('id', $id)->exists()) {
      $course = Curses::find($id);
      $course->delete();

      return response()->json([
        "message" => "records deleted"
      ], 202);
    } else {
      return response()->json([
        "message" => "course not found"
      ], 404);
    }
  }
}
