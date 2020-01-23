<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notes;

class ApiController extends Controller
{
    public function getAllNotes() {
    	 $notes = Notes::get()->toJson(JSON_PRETTY_PRINT);
    	return response($notes, 200);
  }
    }

    public function createNotes(Request $request) {
	$notes = new Notes;
    $notes->text = $request->text;
    $notes->save();

    return response()->json([
        "message" => "Notes record created"
    ], 201);
  }
    }

  	public function getNotes($id) {
    	
    	if (Notes::where('id', $id)->exists()) {
        	$Notes = Notes::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
        	return response($Notes, 200);
      	} else {
        	return response()->json(["message" => "Notes not found"], 404);
      }
  	}

	public function updateNotes(Request $request, $id) {
	    if (Notes::where('id', $id)->exists()) {
	        $Notes = Notes::find($id);
	        $Notes->text = is_null($request->text) ? $Notes->text : $request->text;
	        $Notes->save();

	        return response()->json([
	            "message" => "Records updated successfully"], 200);
	        } else {
	        return response()->json([
	            "message" => "Notes not found"], 404);
    		}
	}	

    public function deleteNotes ($id) {
      if(Notes::where('id', $id)->exists()) {
        $Notes = Notes::find($id);
        $Notes->delete();

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
