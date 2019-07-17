<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\StudentClass;

class classController extends Controller
{
    //
    function addClass(Request $request){
        $this->validate($request, [
            'name_add'         => 'required',
        ]);
        
        $level = Auth::user()->level->priority;
        if($level < 3){
            $class = new StudentClass();
            $class->name = $request->input('name_add');
            $class->save();
            $message = 'Add Class success !!!';
        }else{
            $message = "You don't have permission to create class !!!";
        }
        return redirect('/class/list')->with(compact('message'));
    }

    function getAllClass(){
        $stuclass = StudentClass::all();
        return view('class')->with(compact('stuclass'));
    }

    function updateClass(Request $request){
        $class              =   StudentClass::find($request)->first();
        $class->isActive    =   $request->input('isActive');
        $class->name        =   $request->input('name_update');
        $class->save();
        $message = 'Delete class "'.$request->input('name_update').'" success !!!';
        
        return redirect('/class/list')->with(compact('message'));
    }   

    function autocompleteClass(Request $request){
        $search = $request->get('term');
        $result = StudentClass::where('name', 'LIKE', '%'.$search. '%')->get();

        return response()->json($result);
    }

}
