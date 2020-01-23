<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;

class ApiController extends Controller
{
    public function getAllStudents() {
      $students = Note::get()->toJson(JSON_PRETTY_PRINT);
      return response($students, 200);
    }

    public function createStudent(Request $request) {
      $note = new Note;
      $note->text = $request->text;
      $note->save();

      return response()->json([
        "message" => "Notes record created"
      ], 201);
    }

    public function getNote($id) {
      if (Note::where('id', $id)->exists()) {
        $note = Note::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
        return response($note, 200);
      } else {
        return response()->json([
          "message" => "Notes not found"
        ], 404);
      }
    }

    public function updateNote(Request $request, $id) {
      if (Note::where('id', $id)->exists()) {
        $note = Note::find($id);

        $note->text = is_null($request->text) ? $note->text : $request->text;
        $note->save();

        return response()->json([
          "message" => "Records updated successfully"
        ], 200);
      } else {
        return response()->json([
          "message" => "Notes not found"
        ], 404);
      }
    }

    public function deleteNote ($id) {
      if(Note::where('id', $id)->exists()) {
        $note = Note::find($id);
        $note->delete();

        return response()->json([
          "message" => "Records deleted"
        ], 202);
      } else {
        return response()->json([
          "message" => "Notes not found"
        ], 404);
      }
    }
}