<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use App\BookKind;
use App\Books;
use Exception;
use App\Rentals;

class MainController extends Controller
{
    //

    function home()
    {
        return view('welcome');
    }
    function login()
    {
        return view('login');
    }

    function bookkind()
    {
        $data = BookKind::all();
        return view('bookkind')->with(compact('data'));
    }

    function book()
    {
        $kindlst = BookKind::all();
        $data = Books::all();
        foreach ($data as $row) {
            $kind = BookKind::where('id', $row->kind_id)->first();
            $row->kind = $kind->name;
        }
        return view('book')->with(compact('kindlst', 'data'));
    }

    function rental()
    {
        $kindlst = BookKind::all();
        $data = Rentals::where('isRecieve', false)->get();
        foreach ($data as $row) {
            $book = Books::where('id', $row->book_id)->first();
            $row->book_code = $book->code;
            $row->book_name = $book->name;
        }
        return view('rental')->with(compact('kindlst', 'data'));
    }

    function checkLogin(Request $request)
    {
        $this->validate($request, [
            'email'     => 'required|email',
            'password'  => 'required|min:6',
        ]);

        $user_data = array(
            'email'     => $request->get('email'),
            'password'  => $request->get('password'),
        );

        if (Auth::attempt($user_data)) {
            return redirect('login/successlogin');
        } else {
            return back()->with('error', 'Can not found!');
        }
    }

    function successlogin()
    {
        return view('welcome');
    }

    function logout()
    {
        Auth::logout();
        return view('welcome');
    }

    function addkind(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|min:3',
        ]);

        try {
            $kind           = new BookKind;
            $kind->name     = $request->input('name');
            $kind->code     = 'TL';
            $kind->save();

            $kind->code     .= $kind->id;
            $kind->save();
        } catch (Exception $e) {
            return back()->with('error', 'Something wrong !!!');
        }
        return redirect('bookkind/success');
    }

    function kindsuccess()
    {
        $data = BookKind::all();
        return view('bookkind')->with(compact('data'));
    }

    function addbook(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|min:3',
        ]);

        try {
            $book           = new Books;
            $book->name     = $request->input('name');
            $book->kind_id  = $request->input('kind_id');
            $book->code     = 'S_';
            $book->save();

            $kind_code      = BookKind::find($request->input('kind_id'));
            $book->code     .= $kind_code->code . '_' . $book->id;
            $book->save();
        } catch (Exception $e) {
            return back()->with('error', 'Something wrong !!!');
        }
        return redirect('book/success');
    }

    function booksuccess()
    {
        $kindlst = BookKind::all();
        $data = Books::all();
        return view('book')->with(compact('kindlst', 'data'));
    }

    function fetch(Request $request)
    {
        $value      = $request->get('value');
        $data       = Books::where('kind_id', $value)->get();

        $output     = '<option value="">Select Book</option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }
        echo $output;
    }

    function addrental(Request $request)
    {
        $this->validate($request, [
            'book_id'           => 'required',
            'student_name'      => 'required|min:3',
            'student_class'     => 'required',
        ]);
        try {
            $rental                 = new Rentals;
            $rental->book_id        = $request->get('book_id');
            $rental->student_name   = $request->get('student_name');
            $rental->student_class  = $request->get('student_class');
            $rental->save();
        } catch (Exception $e) {
            return back()->with('error', 'Something wrong !!!');
        }
    }

    function history()
    {
        $data = Rentals::all();
        foreach ($data as $row) {
            $book = Books::where('id', $row->book_id)->first();
            $row->book_code = $book->code;
            $row->book_name = $book->name;
        }
        return view('history')->with(compact('data'));
    }

    function historybystudent(Request $request)
    {
        $stuname = $request->get('stuname');
        $stuclass = $request->get('stuclass');
        $data = Rentals::where('student_name', 'like', '%'.$stuname.'%')
                        ->where('student_class', 'like', '%'.$stuclass.'%')->get();
        foreach ($data as $row) {
            $book = Books::where('id', $row->book_id)->first();
            $row->book_code = $book->code;
            $row->book_name = $book->name;
        }
        return view('history')->with(compact('data'));
    }

    function updaterental(Request $request)
    {
        $checked = $request->get('checked');
        $rental_id = $request->get('id');
        
        try{
            Rentals::find($rental_id)->update(['isRecieve' => $checked]);
            echo true;
        }catch(Exception $e){
            echo false;
        }
        
    }
}
