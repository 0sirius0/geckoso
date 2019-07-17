<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BookKind;

class kindController extends Controller
{
    //
    function addKind(Request $request){
        $this->validate($request, [
            'name'         => 'required',
        ]);
        $kind = new BookKind();
        $kind->name         = $request->input('name');
        $kind->kind_code    = 'TL';
        $kind->save();

        $kind->kind_code .= $kind->id;
        $kind->save();
        $message = 'Add kind "'.$kind->name.'" success';

        return redirect('/kind/list')->with(compact('message'));
    }

    function getKindList(){
        $data = BookKind::paginate(10);

        return view('kindlist')->with(compact('data'));
    }

    function updateKind(Request $request){
        $k_id           = $request->input('kind_id');
        $k_name         = $request->input('name');
        $k_isactive     = $request->input('isActive');

        $kind = BookKind::find($k_id)->first();
        $kind->name     = $k_name;
        $kind->isActive = $k_isactive;

        $kind->save();
    }

    function deleteKind(Request $request){
        $k_id           = $request->input('kind_id');
        $kind           = BookKind::find($k_id);
        $kind->isActive = false;
        $kind->save();
        $message = 'Delete Kind "'.$kind->name.'" success !!!';

        return redirect('/kind/list')->with(compact('message'));
    }

    function autocompleteKind(Request $request){
        $search = $request->get('term');
        $result = BookKind::where('name', 'LIKE', '%'. $search. '%')->get();

        return response()->json($result);
    }
}
