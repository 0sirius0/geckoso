<?php

namespace App\Http\Controllers;
use App\Student;
use Illuminate\Http\Request;
use App\StudentClass;
use Mockery\Exception;

class studentController extends Controller
{
    //
    function addStudent(Request $request){
        $this->validate($request, [
            'name'         => 'required|min:3',
            'class_id'      => 'required',
        ]);
        try{
            $student = new Student();
            $student->name = $request->input('name');
            $student->class_id = $request->input('class_id');
            $student->save();
            $message = '"'.$request->input('name').'" Add success !!!';
        }catch(Exception $e){
            $message = 'Select class for student';
        }
        return redirect('/student/list')->with(compact('message'));
    }

    function getStudentList(){
        $data = Student::paginate(10);
        $class = StudentClass::where('isActive', true)->get();
        return view('studentlist')->with(compact('data', 'class'));
    }

    function getStudentById(Request $request){
        $data = Student::find($request);

        return view('studentlist')->with(compact('data'));
    }

    function updateStudent(Request $request){

    }

    function autocompleteStudent(Request $request){
        $class = $request->input('class_id');
        $result = Student::where([['class_id','=', $class],['isActive','=', true]])->get();

        return $result;
    }

}
